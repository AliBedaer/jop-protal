<?php 


namespace App\Traits;

trait ViewsTrait{


    public function viewsCount()
    {
        return $this->views()->count();
    }


   

}