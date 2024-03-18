<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Comment;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return ResourceCollection
     */
    public function index()
    {
        $comments = Comment::query()->get();
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return CommentResource 
     */
    public function store(Request $request)
    {
        $created = Comment::query()->create([
            //'title' => $request->title,
            'body' => $request
        ]);
        return new CommentResource($created);
    }

    /**
     * Display the specified resource.
     * 
     * @param \App\Models\Comment $comment 
     * @return CommentResource
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment 
     * @return CommentResource | JsonResponse 
     */
    public function update(Request $request, Comment $comment)
    {
        $updated = $comment->update($request->body);

        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model'
                ]
            ], 400);
        }
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $deleted = $comment->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'errors'=>['Failed to delete resource']
            ], 400);
        }

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
