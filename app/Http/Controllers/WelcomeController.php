<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    { 



        return view('welcome',[

        	'jobs'         =>  Job::recentJobs(),
        	'tags'         =>  Tag::popularTags(),
          'seekers'      =>  User::recentSeekers(),
          'componies'    =>  User::topCompanies(),
          'testimonials' =>  Testimonial::testimonials(), 
          
        ]);
    }
}
