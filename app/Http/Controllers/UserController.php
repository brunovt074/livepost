<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
