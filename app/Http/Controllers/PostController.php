<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\View;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('admin')->when(request()->has('keyword'),function($q){
            return $q->where('title','like','%'. request('keyword') .'%')
                     ->orWhere('body','like','%'. request('keyword') .'%');
        })->latest()->paginate(5);
        $recent_posts = Post::latest()->limit(5)->get();
    	return view('frontend.posts.index',compact('posts','recent_posts'));
    }


    public function show($slug)
    {
        $post = Post::whereSlug($slug)
                    ->firstOrFail();
        $next = $post->nextPost;
        $prev = $post->prevPost;
        View::recordView($post);
        return view('frontend.posts.show',compact('post','next','prev'));
    }
}
