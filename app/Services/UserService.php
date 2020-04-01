<?php

namespace App\Services;

use App\Mail\CancelApplier;
use App\Models\CompanyProfile;
use App\Models\SeekerProfile;
use Illuminate\Support\Facades\Mail;
use Storage;
use Toastr;

class UserService 
{

	/**
	* Add role to given user depend on selected level (use in Observer)
	* @param object \App\Models\User $user
	* @return void
	*/
	public function handleRole($user)
	{
		$level = $user->level;
		$user->attachRole($level);
	}

	/**
	* Handle attach profile to each user created ( Use in observer )
	* @param object \App\Models\User $user
	* @return void
	*/

	public function handleProfiles($user)
	{
		if ( $user->hasRole('seeker') )
		{
			$profile = SeekerProfile::create();
			$profile->user()->save($user);
		}

		if ( $user->hasRole('company') )
		{
			$profile = CompanyProfile::create();
			$profile->user()->save($user);
		}
	}


	/**
	* Handle upload cv for user with type seeker
	* @param object $request
	* @param object \App\Models\User $user
	* @return string $path 
	*/
	public function handleUpladCv($request,$user)
	{
		if ( $request->hasFile('cv') )
		{
			$this->checkFile($user->profile->cv);
			return $request->cv->store('cvs');
		}

		return $user->profile->cv;

	}



	/**
	* Handle update profile depend on user type 
	* @param object $request
	* @param object \App\Models\User $user
	* @return void 
	*/


	public function handleUpdateProfile($user,$request)
	{
		if ( $user->hasSeekerProfile )
		{
          


            $user->profile()->update([

                'fullname'   => $request->fullname,
                'mobile'     => $request->mobile,
                'position'   => $request->position,
                'experience' => $request->experience,
                'cv'         => $this->handleUpladCv($request,$user),

            ]);
		}

		if ( $user->hasCompanyProfile )
		{

            $user->profile()->update([

                'size'           => request('size'),
                'specialized_in' => request('specialized_in'),
                'phone'          => request('phone')

            ]);
	   }
 
	
    }

    /**
    * Check given file in storage and delete it if exists
    * @param string $path 
    * @return void
    */
    public function checkFile($file)
    {
    	Storage::has($file) ? Storage::delete($file) : '';
    }


    /**
    * Handle delete profile attached with the given user  (user in observer)
	* @param object \App\Models\User $user
	* @return void
    */
    public function handleDeleteProfiles($user)
    {
    	$user->profile()->delete();
    }


    /**
    * Handle Cancel Applicant who applied for particular job and send email for him 
    * @param \App\Models\Job $job
    * @param \App\Models\User $seeker
    * @param \App\Models\User $company
    * @return void
    **/
    public function handleCancelApplicant($job,$seeker,$company)
    {
    	$job->applicants()->detach($seeker->id);
        Mail::to($seeker->email)->send(new CancelApplier($seeker,$company,$job));
    }
}