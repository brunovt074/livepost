<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::query()->get();

        return new JsonResponse([
            'data' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function store(Request $request)
    {
        $created = Comment::query()->create([
            //'title' => $request->title,
            'body' => $request
        ]);

        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     * 
     * @param \App\Models\Comment $comment 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function show(Comment $comment)
    {
        return new JsonResponse([
            'data' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment 
     * @return \Illuminate\Http\JsonResponse 
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

        return new JsonResponse([
            'data' => $comment
        ]);
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
