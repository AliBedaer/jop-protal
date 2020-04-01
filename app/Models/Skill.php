<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = [ 'name' , 'slug' ];

    protected static function  boot()
    {
    	parent::boot();

    	static::creating(function($skill){
    		$skill->slug = str_slug($skill->name);
    	});

    	static::updating(function($skill){
    		$skill->slug = str_slug($skill->name);
    	});
    }

    public function jobs()
    {
    	return $this->belongsToMany(Job::class)
               ->with('type:id,name','country:id,name')
               ->latest();
    }


    public static function findBySlug($slug)
    {
        return static::with('jobs')->whereSlug($slug)->firstOrFail();
    }
}
