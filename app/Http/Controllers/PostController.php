<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function getAllPosts(){
        $posts=Post::all();
        return response()->json(['posts'=>$posts],200);
    }


}
