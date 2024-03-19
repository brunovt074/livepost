<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 20;
        $comments = Comment::query()->paginate($pageSize);
        
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request     * 
     * @return CommentResource 
     */
    public function store(Request $request, CommentRepository $repository)
    {
        $created = $repository->create($request->only([
            'title',
            'body',
            'user_id',
            'post_id]',
        ]));
       
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
    public function update(Request $request, Comment $comment, CommentRepository $repository)
    {
        $comment = $repository->update($comment, $request->only([
            'title',
            'body',
            'user_id',
            'post_id'
        ]));
        
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment, CommentRepository $repository)
    {
        $deleted = $repository->forceDelete($comment);
        
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
