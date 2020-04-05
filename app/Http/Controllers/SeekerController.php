<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\JobApplyed;
use Illuminate\Support\Facades\Notification;

class SeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:seeker'])->only([
            'saveJob','applyJob','savedJobs','appliedJobs','destroySaved','destroyApplied'
        ]);

    }
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

     public function saveJob($slug)
    {
        if (request()->ajax()) {

            $job  = Job::findBySlug($slug);

            $user = auth()->user();

            $user->savedJobs()->toggle($job);


            if ($user->hasSavedJob($job)) {
                
                return response(['added'=> true], 200);
            }

            return response(['removed' => true], 200);
        }

        abort(404);
        
    } // end of save Job


    public function applyJob($slug)
    {
        if (request()->ajax()) {

            $job  = Job::findBySlug($slug);

            $user = auth()->user();

            $user->appliedJobs()->toggle($job);

            if ($user->hasAppliedJob($job)) {

                Notification::send($job->user, new JobApplyed($job, $user));
                
                return response(['added'=> true], 200);
            }

            return response(['removed' => true], 200);
        }

        abort(404);
    } 


    public function savedJobs()
    {
        $jobs = auth()->user()->savedJobs()->latest()->paginate(5);

        return view('frontend.jobs.saved', compact('jobs'));
    }

    public function destroySaved($slug)
    {
        $job = Job::findBySlug($slug);

        auth()->user()->savedJobs()->detach($job->id);

        return back();
    }


    public function AppliedJobs()
    {
        $jobs = auth()->user()->appliedJobs()->latest()->paginate(5);

        return view('frontend.jobs.applied', compact('jobs'));

    }

    public function destroyApplied($slug)
    {
        $job = Job::findBySlug($slug);

        auth()->user()->appliedJobs()->detach($job->id);

        return back();
    }
}