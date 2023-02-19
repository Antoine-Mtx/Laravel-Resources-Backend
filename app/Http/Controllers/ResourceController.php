<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Services\ResourceService;
use App\Repositories\ResourceRepository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Request $request): Collection
    {
        $resources = Resource::all();
        return $resources;
    }


    public function show(Request $request): A2usersResource
    {
        $resource = ResourceRepository::getOne($request);
        return response()->json($resource);
    }


    public function store(A2usersStoreRequest $request): JsonResponse
    {
//        $a2user = A2users::create($request->all());
//
//        return (new A2usersResource($a2user))
//            ->response()
//            ->setStatusCode(Response::HTTP_CREATED);

        return response()->json('Create');
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
