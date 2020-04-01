<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrontEnd\UserRequest;
use App\Models\User;
use App\Rules\MatchOldPassword;
use App\Services\UserService;
use Illuminate\Http\Request;
use Storage;
use Toastr;

class ProfileController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
	}


    public function ShowEditProfile()
    {
    	$user = auth()->user();
    	return view('frontend.profiles.edit',compact('user'));
    } // end of edit fn 



    public function updateProfile(UserRequest $request,UserService $service)
    {
        $data = $request->except(['image']);

        $user = auth()->user();

        if ( $request->hasFile('image') )
        {            
            $data['image'] = upload('image','users',200,200,$user->image);
        }

        $user->update($data);

        $service->handleUpdateProfile($user,$request);


        Toastr::success('Profile updated!');

        return back();
    	
    } // end of update profile fn 


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password'              => ['required',new MatchOldPassword()],
            'new_password'              => ['required'],
            'new_password_confirmation' => ['same:new_password'] 
        ]);
        auth()->user()->update(['password' => $request->password]);
        auth()->logout();
        Toastr::success('Password changed!');
        return redirect(url('login'));

    } // end of change pass fn 
}
