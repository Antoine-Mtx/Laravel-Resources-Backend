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


    public function show(Request $request, Resource $resource): ResourceResource
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


    public function update(Request $request, Resource $resource)
    {
        $resource->update($request->all());

        return (new ResourceResource($resource))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }


    public function destroy(Resource $resource)
    {
        $resource->update(['archived' => 1]);
        return (new ResourceResource($resource))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
