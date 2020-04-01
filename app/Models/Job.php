<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Job extends Model
{

    protected $fillable = [
    	'title',
        'slug',
        'banner',
        'description',
    	'exp_level',
    	'salary',
    	'type_id',
    	'category_id',
        'country_id',
    	'user_id',
    	'apply_url',
    ];


    /**
    * Scope To Get Recent Jobs 
    * @param query $q 
    * @param int $limit ( pagination )
    * @return void 
    */

    public function scopeRecentJobs($q,$limit=5)
    {
        return $q->with('type:id,name','country:id,name')
                          ->limit(5)
                          ->orderBy('created_at','desc')
                          ->get();
    }

    /**
    * One To Many Relationship every job Belong to one user   
    *
    * @return void 
    */

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
    * Each job has many tags Morph relation 
    * @return void 
    */
    public function tags()
    {
    	return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
    * Many to many relation ship job_skill table 
    * @return void 
    */
    public function skills()
    {
    	return $this->belongsToMany(Skill::class);
    }


    /**
    * Many to many relation ship job_seeker table 
    * @return void 
    */

    public function seekers()
    {
        return $this->belongsToMany(User::class,'job_seeker')
                     ->with('savedJobs');
    }

    /**
    * Many to many relation ship job_applicant table 
    * @return void 
    */

    public function applicants()
    {
        return $this->belongsToMany(User::class,'job_applicant')
                    ->with('appliedJobs');
    }

    /**
    * Custom attr to get path of image 
    * @return string path
    */
    public function getImagePathAttribute()
    {
        return Storage::url($this->banner);
    }

    /**
    * Custom attr to get show url for each particular instance 
    *
    * @return string path 
    */
    public function getShowUrlAttribute()
    {
        return route('jobs.show',$this->slug);
    }

    public static function findBySlug($slug)
    {
        return static::with('tags','skills','country','type')->whereSlug($slug)->firstOrFail();
    }

    public function relatedJobs($limit=5)
    {
        return static::with('tags','skills','country','type')->where('id','!=',$this->id)->where('title','like', '%'. $this->title .'%')
                  ->limit($limit)
                  ->get();
    }


    /**
    * method to dublicate particular job and return by new one 
    *
    * @return object 
    */

    public function dublicateJob()
    {
        $new_job = $this->replicate(['banner']);
        $new_job->title = $this->title . '-(dublicated)';
        $new_job->slug = str_slug($new_job->title);
        $new_job->push();

        foreach ( $this->skills as $skill )
        {
            $new_job->skills()->attach($skill);
        }

        foreach ( $this->tags as $tag )
        {
            $new_job->tags()->attach($tag);
        }


        return $new_job;
    }


   
    

}
