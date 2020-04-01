<?php

namespace App\Observers;
use App\Models\CompanyProfile;
use App\Models\SeekerProfile;
use App\Models\User;
use App\Services\UserService;




class UserObserver
{

    private $service;

    public function __construct(UserService $userService)
    {
      $this->service =  $userService;  
    }

    public function created(User $user)
    {
       $this->service->handleRole($user);
    }



    public function roleAttached(User $user)
    {
      $this->service->handleProfiles($user);
    }


    public function deleted(User $user)
    {
      $this->service->handleDeleteProfiles($user);
      
      if ( $user->hasSeekerProfile )
      {
        check_file($user->profile->cv);
      }
      check_file($user->image);
    }


    
}
