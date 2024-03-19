<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\PostRepository;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * - Pagination is a notion of displaying our query results by page,
     * otherwise we would have to send everything to the client.
     * 
     * - We call the paginate() method on our query to create a paginator.
     * We can then pass the paginator to our resource collection for a paginated
     * JSON response
     * 
     * @param Request
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 20;
        $posts = Post::query()->paginate($pageSize);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return PostResource
     * 
     * - Database Transaction groups mul;tiple database operations 
     * together and only applies the operations when all of them passed.
     * 
     * - We use the transaction() method in the DB façade to trigger a transaction.
     *      
     */
    public function store(Request $request, PostRepository $repository)
    {
        $created = $repository->create($request->only([
            'title',
            'body',
            'user_ids'
        ]));

        return new PostResource($created);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Post $post     * 
     * @return PostResource 
     */
    public function show(Post $post)
    {     
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post     * 
     * @return PostResource | JsonResponse
     */
    public function update(Request $request, Post $post, PostRepository $repository)
    {
        $post = $repository->update($post, $request->only([
            'title',
            'body',
            'user_ids'
        ]));

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post     * 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $post = $repository->forceDelete($post);
        
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
