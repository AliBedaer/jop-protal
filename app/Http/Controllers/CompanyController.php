<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:company'])->except(['index']);
    }

	public function index()
	{
		$companies = User::companies();
    	return view('frontend.companies.index',compact('companies'));

	} // end of index fn 
    
    public function jobs()
    {
    	$jobs = auth()->user()->jobs()
    	       ->paginate(10);

    	return view('frontend.companies.jobs',compact('jobs'));

    } // end of fn 


    public function cancelApplicant(Job $job,User $seeker,$companyId,UserService $service)
    {
        if ( request()->ajax())
        { 

          $company  = User::findOrFail($companyId);

          $service->handleCancelApplicant($job,$seeker,$company);

          return response(['canceld'=> true]);

        }
        
        abort(404);

    } // end of fn


    public function notifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return view('frontend.notifications.index');

    } // end of fn 

}
