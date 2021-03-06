<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrontEnd\JobRequest;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\Request;
use Toastr;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:company'])->only(['create','store']);
        $this->middleware(['auth','role:company','can:update,job'])->only(['edit','update']);
        $this->middleware(['auth','role:company','can:delete,job'])->only(['destroy']);
        
    } // end of constructor


    public function index()
    {

        
        $jobs = Job::with('type:id,name', 'country:id,name')->latest();

        if (request()->has('keyword') and !empty(request('keyword'))) {
            $jobs = $jobs->where('title', 'like', '%'. request('keyword') .'%');
        }

        if (request()->has('type') && !empty(request('type'))) {
            $jobs = $jobs->whereHas('type', function ($q) {
                return $q->where('name', request('type'));
            });
        }

        if (request()->has('category') and !empty(request('category'))) {
            $jobs = $jobs->whereHas('category', function ($q) {
                return $q->where('name', request('category'));
            })->latest();
        }

        if (request()->has('country') and !empty(request('country'))) {
            $jobs = $jobs->whereHas('country', function ($q) {
                return $q->where('name', request('country'));
            });
        }

        $jobs = $jobs->paginate(10);

        return view('frontend.jobs.index', compact('jobs'));

    } // end of index 

    public function create()
    {
        return view('frontend.jobs.create');

    } // end of create

    public function store(JobRequest $request,JobService $service)
    {
        $data = $request->except(['banner','tags','skills']);

        if ($request->hasFile('banner')) 
        {
            $data['banner'] = upload('banner', 'jobs', 250, 250);
        }

        $job = auth()->user()->jobs()->create($data);

        $service->handleJobSkillsTags($job,$request);

        Toastr::success('Added!');

        return redirect()->route('jobs.show', $job->slug);
    } // end of store 


    public function update(JobRequest $request, Job $job,JobService $service)
    {
        $data = $request->except(['banner','tags','skills']);

        if ($request->hasFile('banner')) {

            $data['banner'] = upload('banner', 'jobs', 250, 250, $job->banner);

        }

        $job->update($data);

        $service->handleJobSkillsTags($job,$request);

        Toastr::success('updated!');

        return back();
    } // end of update 

    public function show($slug)
    {
        $job = Job::findBySlug($slug);

        $r_jobs = $job->relatedJobs(); // Stand for related jobs

        return view('frontend.jobs.show', compact('job', 'r_jobs'));

    } // end of show 


    public function edit(Job $job)
    {
        return view('frontend.jobs.edit', compact('job'));

    } // end of edit 


    public function destroy(Job $job)
    {
        $job->delete();

        Toastr::success('Job deleted!');

        return redirect()->route('jobs.index');
        

    } // end of destroy


   
}
