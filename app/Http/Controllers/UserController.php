<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 20;
        $users = User::query()->paginate($pageSize);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return UserResource
     */
    public function store(Request $request, UserRepository $repository)
    {        

        $created = $repository->create($request->only([
            'name',
            'email',            
        ]));        

        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return UserResource | JsonResponse
     */
    public function update(Request $request, User $user, UserRepository $repository)
    {
        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        
        $user = $repository->update($user, $request->only([
            'name',
            'email',
        ]));
        
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function destroy(User $user, UserRepository $repository)
    {
        $deleted = $repository->forceDelete();
        
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}