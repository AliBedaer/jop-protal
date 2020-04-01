<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($slug)
    {
    	$skill = Skill::findBySlug($slug);
    	$jobs  = $skill->jobs()->paginate(10);     
    	return view('frontend.skills.show',compact('skill','jobs'));
    } // end of show fn 
}
