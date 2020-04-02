<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{

    use Notifiable;
    use LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'password','level','info','github','facebook',
        'linkedin','twitter','image'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['profile'];

    /**
    * Scope to limit users that bring role company
    * @param mixed $query
    * @param int $limit --> related to paginataion
    **/
    public function scopeCompanies($query,$limit=12)
    {
        return $query->whereRoleIs('company')
                     ->withCount('jobs')
                     ->latest()
                     ->paginate($limit);
    }


    /**
    * Scope to limit users that bring role seeker
    * @param mixed $query
    * @param int $limit --> related to paginataion
    **/
    public function scopeSeekers($query,$limit=12)
    {
        return $query->whereRoleIs('seeker')
                     ->withCount('jobs')
                     ->latest()
                     ->paginate($limit);
    }



    public function scopeRecentSeekers($q,$limit=5)
    {
        return $q->whereRoleIs('seeker')->orderBy('created_at','desc')
                          ->limit($limit)
                          ->get();
    }


    public function scopeTopCompanies($q,$limit=4)
    {
        return $q->whereRoleIs('company')
                         ->withCount('jobs')
                         ->orderBy('jobs_count','desc')
                         ->limit($limit)
                         ->get();  
    }


    /**
    * Set Hashed password before inserting to users table 
    * @param string $value --> pass 
    * @return void
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
    * Relation ship between users and profile one to one 
    * @return void
    */

    public function profile()
    {
        return $this->morphTo();
    }

    public function getSeekerShowAttribute()
    {
        return route('seekers.show',['id' => $this->id,'slug' => str_slug($this->name)]);
    }


    public function getCompanyShowAttribute()
    {
        return route('companies.show',['id' => $this->id,'slug' => str_slug($this->name)]);
    }

    /**
    * Check profile type of user instance 
    * @return bool
    */

    public function getHasSeekerProfileAttribute()
    {
        return $this->profile_type == 'App\Models\SeekerProfile';
    }

    /**
    * Check profile type of user instance 
    * @return bool
    */

    public function getHasCompanyProfileAttribute()
    {
        return $this->profile_type == 'App\Models\CompanyProfile';
    }

    /**
    * Relation get all jobs whose created by company one to many
    * @return void
    */

    public function jobs()
    {
        return $this->hasMany(Job::class)
                ->with('type:id,name','country:id,name')
                ->withCount('applicants')
                ->latest();
    }

    /**
    * Relation get all jobs whose applied by seeker many to many
    * @return void
    */
   
    public function appliedJobs()
    {
        return $this->belongsToMany(Job::class,'job_applicant');
    }

    /**
    * Add attribute to instance called imagePath to get path of image
    * @return string path
    */
    public function getImagePathAttribute()
    {
        return url('storage/'.$this->image);
    }


    /**
    * Relation get all jobs whose saved by seeker many to many
    * @return void
    */

    public function savedJobs()
    {
        return $this->belongsToMany(Job::class,'job_seeker');
    }

    /**
    * Check of seeker saved the given job
    * @param object $job
    * @return bool
    */
    public function hasSavedJob($job)
    {
        $seekersIds = $job->seekers()->allRelatedIds()->toArray();
        $userId     = $this->id;

        return in_array($userId,$seekersIds);
    }


     /**
    * Check of seeker applied for the given job
    * @param object $job
    * @return bool
    */

    public function hasAppliedJob($job)
    {
        $applicantsIds = $job->applicants()->allRelatedIds()->toArray();
        $userId        = $this->id;

        return in_array($userId,$applicantsIds);
    }
}
