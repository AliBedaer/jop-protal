<?php 


namespace App\Services;


class JobService {
	

	/**
	* Handel Tags And Skills for each jobs
	* @param object \app\models\Job $job
	* @param $request
	* @return void
	*/

	public function handleJobSkillsTags($job,$request)
	{
		$job->tags()->sync($request->tags);
		$job->skills()->sync($request->skills);
	}


	/**
	* Handle Delete Tags Morph Relations on delete ( Observer ) 
	* @param object \App\Models\Job $job
	* @return void
	*/

	public function handleDetachTags($job)
	{
		$job->tags()->detach($job->tags);
	}


}