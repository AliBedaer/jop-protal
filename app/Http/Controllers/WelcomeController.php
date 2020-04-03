<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class WelcomeController extends Controller
{
    public function index()
    { 



        return view('welcome',[

        	'jobs'      =>  Job::recentJobs(),
        	'tags'      =>  Tag::popularTags(),
          'seekers'     =>  User::recentSeekers(),
          'componies'   =>  User::topCompanies() 
          
        ]);
    }
}
