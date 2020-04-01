<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	protected $table = 'countries';
    protected $fillable = ['name','slug'];


    protected static function  boot()
    {
    	parent::boot();

    	static::creating(function($country){
    		$country->slug = str_slug($country->name);
    	});

    	static::updating(function($country){
    		$country->slug = str_slug($country->name);
    	});
    }

    public function jobs()
    {
   	  return $this->hasMany(Job::class);
    }
}
