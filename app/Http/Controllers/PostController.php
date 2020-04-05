<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\View;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
    	$posts        = Post::with('admin')->latest()->paginate(5);
        $recent_posts = Post::with('admin')->latest()->limit(5)->get(); 
    	return view('frontend.posts.index',compact('posts','recent_posts'));
    }


    public function show($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        $next = $post->nextPost;
        $prev = $post->prevPost;
        View::recordView($post);
    	return view('frontend.posts.show',compact('post','next','prev'));
    }
}
