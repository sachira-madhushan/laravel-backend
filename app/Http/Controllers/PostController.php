<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum',except:['getAllPosts','getPost'])
        ];
    }
    public function getAllPosts(){
        $posts=Post::all();
        return response()->json(['posts'=>$posts],200);
    }


    public function createPost(Request $request){
        $validated=$request->validate([
            "title"=>"string|required",
            "body"=>"required|string"
        ]);

        $post=$request->user()->posts()->create($validated);
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

    public function getUserPosts(Request $request){
        $posts = $request->user()->posts;
        return response()->json(["posts"=>$posts],200);
    }

    public function deletePost($id){

        $post =Post::find($id);

        if($post){
            Gate::authorize('modify',$post);
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
            Gate::authorize('modify',$post);
            $post->title=$request->title;
            $post->body=$request->body;
            $post->save();
            return response()->json(["message"=>"Post updated","post"=>$post],200);
        }else{

            return response()->json(["message"=>"Post not found"],404);
        }
    }

}
