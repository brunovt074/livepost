<?php

use App\Helpers\Routes\RouteHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
| - API routes typically refers to routes that return JSON
*/

Route::prefix('v1')
    ->group(function(){
        
        RouteHelper::includeRouteFiles(__DIR__ . '/api/v1');
        
        // the method above, replaces the less convenient way below
        //    require __DIR__ . '/api/v1/users.php';
        //    require __DIR__ . '/api/v1/posts.php';
        //    require __DIR__ . '/api/v1/comments.php';
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
