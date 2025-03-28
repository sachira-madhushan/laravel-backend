<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPosts(){
        $posts=Post::all();
        return response()->json(['posts'=>$posts],200);
    }

    public function createPost(Request $request){
        $validated=$request->validate([
            "title"=>"string|required",
            "body"=>"required|string"
        ]);

        $post=Post::create($validated);
        return response()->json(["message"=>"Post created","post"=>$post],201);
    }


}
