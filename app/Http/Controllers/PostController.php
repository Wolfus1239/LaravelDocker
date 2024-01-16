<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PostController
{
    public function view(Request $request)
    {
        $paginate = $request->paginate;
        if(empty($paginate) or $paginate == 0){
            $paginate = 5;
        }
        $posts = DB::table("posts")->paginate($paginate);
        return view('welcome',['posts' => $posts]);
    }
    public function read(Request $request)
    {
        $paginate = $request->paginate;
        if(empty($paginate) or $paginate == 0){
            $paginate = 10;
        }
        $posts = DB::table("posts")->paginate($paginate);
        return response()->json(['posts' => $posts]);
    }
    public function create(Request $request)
    {
         Post::create([
            'header' => $request->header,
            'text' => $request->text,
        ]);
    }
    public function update($id, Request $request)
    {
        $post_table = DB::table("posts")->where('id','=',$id)->first();
        if(!empty($post_table)){
            $product = DB::table("posts")->where('id','=',$id)->update([ 'header' => $request['header'], 'text' => $request['text']]);
            return response()->json(['posts' => $product]);
        }
        return response()->json(['posts' => $post_table]);
    }
    public function delete($id)
    {
        $delete_table = DB::table("posts")->where('id','=',$id)->first();
        if(!empty($delete_table)){
            $product = DB::table("posts")->where('id','=',$id)->delete();
            return response()->json(['posts' => $product]);
        }
        return response()->json(['posts' => $delete_table]);
    }
    public function view_slug($slug)
    {
        $slug_table = DB::table("posts")->where('slug','=',$slug)->get();
        if(!empty($slug_table)){
            return view('post',['posts' => $slug_table]);
        }
        return response()->json(['posts' => 'error']);
    }
}
