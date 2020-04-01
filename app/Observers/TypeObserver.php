<?php

namespace App\Observers;

use App\Models\Type;

class TypeObserver
{
    public function creating($type)
    {
       $type->slug = str_slug($type->name);
    }

    public function updating($type)
    {
    	$type->slug = str_slug($type->name);
    }
}
