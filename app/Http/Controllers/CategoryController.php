<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * @desc Renvoi toutes les catégories (get api/category)
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $category = Category::all();
        return response()->json(CategoryResource::collection($category));
    }

    /**
     * @desc Renvoi une catégorie (get : api/category/id)
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Request $request, Category $category): JsonResponse
    {
        return response()->json(new CategoryResource($category));
    }

    /**
     * @desc Ajoute une catégorie (post : api/category + {data})
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $category = Category::create($request->all());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @desc Modifie une catégorie (patch : api/category/id + {data})
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $category->update($request->all());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @desc Archive une catégorie (delete : api/category/id)
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Request $request, Category $category): JsonResponse
    {
        $category->update(['archived' => 1]);
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
