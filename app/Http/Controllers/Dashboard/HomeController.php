<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index()
    {
    	
    	$title           = trans('dashboard.home');
    	$admins_count    = Admin::all()->count();
    	$seekers_count   = count(User::with('profile')->where('level','seeker')->get());
    	$countries_count = count(Country::all()); 
    	return view('dashboard.home',compact('title','admins_count','seekers_count','countries_count'));

    } // End of index fn
}
