<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    use BaseTrait;
    protected $fillable = [ 'name' , 'slug' ];


    protected static function  boot()
    {
    	parent::boot();

    	static::creating(function($tag){
    		$tag->slug = str_slug($tag->name);
    	});

    	static::updating(function($tag){
    		$tag->slug = str_slug($tag->name);
    	});
    }


    public function scopePopularTags($q)
    {
        return $q->withCount('jobs')
                 ->orderBy('jobs_count')
                 ->get(); 
    }


    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'taggable');
    }



    public function jobs()
    {
        return $this->morphedByMany('App\Models\Job', 'taggable')
                    ->with('country:id,name','type:id,name')
                    ->latest();
    }




   



    

}
