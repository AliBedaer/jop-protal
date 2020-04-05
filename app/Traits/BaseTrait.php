<?php 


namespace App\Traits;




trait BaseTrait
{
    public static function findBySlug($slug)
    {
        return static::where('slug',$slug)->firstOrFail();
    }
}
