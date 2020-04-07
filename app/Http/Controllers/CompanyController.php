<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Jobs\CanceldEmails;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:company'])->except(['index','show']);
    }

	public function index()
	{
        
		$companies = User::companies()->withCount('jobs')->paginate(12);
    	return view('frontend.companies.index',compact('companies'));

	} // end of index fn 


    public function show($id,$slug)
    {
        $company = User::findOrFail($id);
        return view('frontend.companies.show',compact('company'));
    }
    
    /**
     * Get All Jobs created by user ( Company )
     */
    public function jobs()
    {
    	$jobs = user()->jobs()
    	       ->paginate(10);

    	return view('frontend.companies.jobs',compact('jobs'));

    } // end of fn 


    public function cancelApplicant($job_id,$seeker_id,$company_id)
    {
        if ( request()->ajax())
        { 

          $company  = User::findOrFail($company_id);
          $seeker   = User::findOrFail($seeker_id);
          $listing  = Job::findOrFail($job_id); 

          $listing->applicants()->detach($seeker);

          dispatch(new CanceldEmails($seeker,$company,$listing));

          return response(['canceld'=> true]);

        }
        
        abort(404);

    } // end of fn


    public function notifications()
    {
        user()->unreadNotifications->markAsRead();
        return view('frontend.notifications.index');

    } // end of fn 

}
