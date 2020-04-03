<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SeekerController extends Controller
{
    public function index()
    {
    	$seekers = User::seekers()->paginate(10);
    	return view('frontend.seekers.index',compact('seekers'));
    }

    public function show($id,$slug)
    {
    	$seeker = User::findOrFail($id);
    	return view('frontend.seekers.show',compact('seeker'));
    }
}
