<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{
    #region ROUTES CRUD
    /**
     * @desc Renvoi toutes les ressources (get api/resource)
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $resources = Resource::all();
        return response()->json(ResourceResource::collection($resources));

    }

    /**
     * @desc Renvoi une ressource (get : api/resource/id)
     * @param Request $request
     * @param Resource $resource
     * @return JsonResponse
     */
    public function show(Request $request, Resource $resource): JsonResponse
    {
        return response()->json(new ResourceResource($resource));
    }

    /**
     * @desc Ajoute une ressource (post : api/resource + {data})
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $resource = Resource::create($request->all());

            $type = match ($request->type) {
                'information' => InformationController::store($resource->id, $request->information),
                'event' => true,
                'tutorial' => TutorialController::store($resource->id, $request->tutorial),
            };

            return (new ResourceResource($resource))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $e) {
            return self::sendError($e->getMessage());
        }
    }

    /**
     * @desc Modifie une ressource (patch : api/resource/id + {data})
     * @param Request $request
     * @param Resource $resource
     * @return JsonResponse
     */
    public function update(Request $request, Resource $resource): JsonResponse
    {
        $resource->update($request->all());

        return (new ResourceResource($resource))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @desc Archive une ressource (delete : api/resource/id)
     * @param Request $request
     * @param Resource $resource
     * @return JsonResponse
     */
    public function destroy(Request $request, Resource $resource): JsonResponse
    {
        $resource->update(['archived' => 1]);
        return (new ResourceResource($resource))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
    #endregion


    #region ROUTES CUSTOM
    /**
     * @desc Liste ressources visibles + non archivées , avec auteur (user) & category
     * @param Request $request
     * @return JsonResponse
     */
    public function get_visible_resources(Request $request): JsonResponse
    {
        $resources = ResourceRepository::get_visible_resources();
        return response()->json($resources);
    }

    /**
     * @desc Une ressource avec auteur (user) & category & type (info ou tuto) & comments
     * @param Request $request
     * @return JsonResponse
     */
    public function get_one_resource(Request $request): JsonResponse
    {
        $resource = match ($request->type) {
            'information' => ResourceRepository::get_one_information($request->id),
            'tutorial' => ResourceRepository::get_one_tutorial($request->id)
        };
        return response()->json($resource);
    }
    #endregion
}
