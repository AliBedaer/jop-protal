<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug)
    {
    	$tag = Tag::findBySlug($slug);
    	$jobs = $tag->jobs()->paginate(10);

    	return view('frontend.tags.show',compact('tag','jobs'));
    }
}
