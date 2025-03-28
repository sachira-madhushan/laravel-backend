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


    public function getPost($id){
        $post =Post::find($id);

        if($post){
            return response()->json(["post"=>$post],200);
        }else{
            return response()->json(["message"=>"Post not found"],404);
        }
    }

    public function deletePost($id){
        $post =Post::find($id);

        if($post){
            $post->delete();
            return response()->json(["message"=>"Post deleted"],200);
        }else{
            return response()->json(["message"=>"Post not found"],404);
        }
    }

    public function updatePost(Request $request,$id){
        $validated=$request->validate([
            "title"=>"string|required",
            "body"=>"required|string"
        ]);

        $post=Post::find($id);

        if($post){
            $post->title=$request->title;
            $post->body=$request->body;
            $post->save();
            return response()->json(["message"=>"Post updated","post"=>$post],200);
        }else{

            return response()->json(["message"=>"Post not found"],404);
        }
    }

}
