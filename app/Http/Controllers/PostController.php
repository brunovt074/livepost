<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::query()->get();

        return new JsonResponse([
            'data'=> $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function store(Request $request)
    {
        $created = Post::query()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Post $post     * 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function show(Post $post)
    {     
        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post     * 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function update(Request $request, Post $post)
    {
        $updated = $post->update($request->only(['title','body']));

        //more verbose way (explicit)
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]);

        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
            ], 400);
        }

        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post     * 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function destroy(Post $post)
    {
        $delete = $post->forceDelete();

        if(!$delete){
            
            return new JsonResponse([
                'errors'=> [
                    'Could not delete resource.'                ]
            ], 400);
        }

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
