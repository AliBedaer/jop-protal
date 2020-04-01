<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
    	$posts        = Post::with('admin')->latest()->paginate(10);
        $recent_posts = Post::with('admin')->latest()->limit(5)->get(); 
    	return view('frontend.posts.index',compact('posts','recent_posts'));
    }


    public function show($slug)
    {
    	$post = Post::whereSlug($slug)->firstOrFail();
    	return view('frontend.posts.show',compact('post'));
    }
}
