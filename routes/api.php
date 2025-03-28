<?php

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
});
