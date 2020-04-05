<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function jobsShow($slug)
    {
    	$tag = Tag::findBySlug($slug);
    	$jobs = $tag->jobs()->paginate(10);

    	return view('frontend.tags.jobs.show',compact('tag','jobs'));
    }

    public function postsShow($slug)
    {
        $tag   = Tag::findBySlug($slug);
        $posts = $tag->posts()->with('admin')->paginate(5);

        return view('frontend.tags.posts.show',compact('tag','posts'));
    }
}
