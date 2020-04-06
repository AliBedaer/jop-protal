<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name','say'];


    public function scopeTestimonials($q,$limit=5){

        return $q->latest()->limit($limit)->get();

    }
}
