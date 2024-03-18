<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return ResourceCollection
     */
    public function index()
    {
        $users = User::query()->get();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $created = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

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
    public function update(Request $request, User $user)
    {
        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        $updated = $user->update($request->only([
            'name',
            'email',
        ]));

        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
            ], 400);
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function destroy(User $user)
    {
        $delete = $user->forceDelete();

        if(!$delete){
            return new JsonResponse([
                'errors' => [
                    'Could not delete resource'
                ]
            ], 400);
        }

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}