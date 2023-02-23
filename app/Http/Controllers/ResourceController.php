<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use App\Services\ResourceService;
use App\Repositories\ResourceRepository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return ResourceResource::collection(Resource::all());
    }


    public function show(Resource $resource, Request $request): ResourceResource
    {
        return new ResourceResource($resource);
    }


    public function store(Request $request)
    {
        $resource = Resource::create($request->all());

        return (new ResourceResource($resource))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    public function update(A2usersUpdateRequest $request, A2users $a2user): JsonResponse
    {
//        $a2user->update($request->all());
//
//        return (new A2usersResource($a2user))
//            ->response()
//            ->setStatusCode(Response::HTTP_ACCEPTED);

        return response()->json('Edit');
    }


    public function destroy(A2users $a2user): HttpResponse
    {
//        $a2user->delete();

        return response()->json('Delete');
    }
}
