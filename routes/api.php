<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'prefix'=>'posts'
],function(){
    Route::get('',[PostController::class,'getAllPosts']);
    Route::post('create',[PostController::class,'createPost']);
    Route::get('{id}',[PostController::class,'getPost']);
    Route::delete('{id}',[PostController::class,'deletePost']);
    Route::put('{id}',[PostController::class,'updatePost']);
});

Route::group([
    'prefix'=>'users',
],function(){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
});
