<?php

use Illuminate\Support\Facades\Route;

//mapped syntax
Route::middleware([
    //'auth',
    //\App\Http\Middleware\RedirectIfAuthenticated::class,
    ])
    ->name('users.')
    ->namespace('\App\Http\Controllers')
    ->group(function(){
        
        Route::get('/users',[\App\Http\Controllers\UserController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth');

        Route::get('/users/{user}',[\App\Http\Controllers\UserController::class, 'show'])
            ->name('show')
            //query validations
            //->where('user','[0-9]+')//with regex
            ->whereNumber('user'); //the same as above, but more beautyful

        Route::post('/users','UserController@store')
            ->name('store');

        Route::patch('/users/{user}',[\App\Http\Controllers\UserController::class, 'update'])
        ->name('update');

        Route::delete('/users/{user}',[\App\Http\Controllers\UserController::class, 'destroy'])
        ->name('destroy');
    });

//array syntax
// Route::group([
//     'middleware'=>[
//         'auth',
//     ],
//     'prefix' => 'heyaa',
//     'as' => 'users.',
//     'namespace' => '\App\Http\Controllers',

// ], function(){
//         Route::get('/users','UserController@index')->name('index');

//         Route::get('/users/{user}','UserController@show')->name('show');

//         Route::post('/users','UserController@store')->name('store');

//         Route::patch('/users/{user}','UserController@update')->name('update');

//         Route::delete('/users/{user}','UserController@destroy')->name('destroy');

// });