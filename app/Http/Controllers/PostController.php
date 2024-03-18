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
     */
    public function show(Post $post)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
