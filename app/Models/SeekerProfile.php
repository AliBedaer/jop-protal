<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->morphOne(User::class,'profile');
    }


    
}
