<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


   /**
   * Values that can be filled by user in Model
   * @var array
   */

   protected $fillable = [ 'name' , 'slug' ];

   
   protected static function  boot()
    {
    	parent::boot();

    	static::creating(function($category){
    		$category->slug = str_slug($category->name);
    	});

    	static::updating(function($category){
    		$category->slug = str_slug($category->name);
    	});
    }



   /**
   * One To Many relation
   *
   * @return void 
   * 
   */

   public function jobs()
   {
   	 return $this->hasMany(Job::class)
            ->with('type:id,name','country:id,name');
            
   }


   /**
   * Method to get instance by given slug like FindOrFail but not by Id
   *
   * @param string $slug
   * @return \App\Models|Category $category 
   */

   public static function findBySlug($slug)
   {
    return static::with('jobs')->whereSlug($slug)->firstOrFail();
   }
}
