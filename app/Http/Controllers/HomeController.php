<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    public function getPostBySlug($id)
    {
        $post = Post::with('user', 'category')->where('id', $id)->first();
        return response()->json([
            'message' => "Success",
            'post' => $post
        ], 200);
    }
    public function getPostByCategory($id)
    {
        $posts = Post::with('user', 'category')->where('category_id', $id)->orderBy('id', 'desc')->get();
        return response()->json([
            'post' => $posts
        ], 200);
    }
    
    public function search_post(){

     $search = \Request::get('s');
        if($search!=null){
            $posts = Post::with('user','category')
                ->where('title','LIKE',"%$search%")
                ->orWhere('description','LIKE',"%$search%")
                ->get();
            return response()->json([
                'post'=>$posts
            ],200);
        }else{
           return $this->get_all_blog_post();
        }

    }
}
