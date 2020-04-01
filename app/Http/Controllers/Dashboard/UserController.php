<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Toastr;
use Image;

class UserController extends Controller
{

    /**
    * Render datatable data 
    * @param object $users
    * @return void
    */
    
    public function index(UsersDataTable $users)
    {
       
    	return $users->render('dashboard.users.index',['title' => trans('dashboard.users')]);

    } 

    /**
    * Render create view 
    * @return object 
    */

    public function create()
    {
    	return view('dashboard.users.create',['title' => trans('dashboard.add_new_user')]);

    }

    /**
    * Store given data in db 
    * @param object $request
    * @return void
    */
    public function store(UserRequest $request)
    {       
        $user = User::create($request->all());

        Toastr::success(trans('dashboard.success_added'));

        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.users.edit',$user->id));
        }

        if ( $request->action == 'save-add' )

        {
            return back();
        }

        return redirect(route('dashboard.users.index'));

    } // end of store fn


    public function edit(User $user)
    {
        $title = trans('dashboard.edit',['name' => $user->name]);
        return view('dashboard.users.edit',compact('user','title'));

    } // End of edit fn


    public function update(User $user,UserRequest $request,UserService $service)
    {

        $data = $request->except(['image']);

        if ( $request->hasFile('image') )
        {            
            $data['image'] = upload('image','users',48,48,$user->image);
        }

        $user->update($data);

        $service->handleUpdateProfile($user,$request);


        Toastr::success(trans('dashboard.success_updated'));

        return back();

    } // End of update fn



    public function destroy(User $user)
    {
        $user->delete();
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.users.index'));
        
    } // End of destroy fn




    public function destroyAll()
    {
        User::destroy(request('item'));
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.users.index'));

    } // End Of destroyAll fn


}
