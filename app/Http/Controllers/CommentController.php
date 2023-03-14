<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * @desc Renvoi tous les commentaires (get api/comment)
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $comments = Comment::all();
        return response()->json(CommentResource::collection($comments));
    }

    /**
     * @desc Ajoute un commentaire (post : api/comment + {data})
     * @param Request $request
     * @return JsonResponse
     */
    public static function store(Request $request): JsonResponse
    {
        $comment = Comment::create($request->all());

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @desc Archive un commentaire (delete : api/comment/id)
     * @param Request $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Request $request, Comment $comment): JsonResponse
    {
        $date = date('Y-m-d H:i:s');
        $comment->update(['archived' => 1, 'moderated_at' => $date]);
        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
