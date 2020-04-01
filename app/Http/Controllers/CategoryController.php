<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
    	$category = Category::findBySlug($slug);
    	$jobs = $category->jobs()->paginate(10);
    	
    	return view('frontend.categories.show',compact('category','jobs'));
    }
}
