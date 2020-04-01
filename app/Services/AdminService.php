<?php

namespace App\Services;

use Toastr;

class AdminService 
{

	
	

	public function store($request)
	{
		$admin = $this->model->create($this->handleDataStore($request));
		$this->handleMessages(); 
		return $admin;
	}

	public function update($admin,$request)
	{
		$admin->update($this->handleDataUpdate($request,$admin));
		$this->handleMessages();
	}

	public function destroy($admin)
	{
		$this->handleDeleteImage($admin->image);
		$admin->delete();
		$this->handleMessages();

	}


	public function destroyAll($arr=[])
	{
		$admins = $this->model->filterd($arr);

		foreach ($admins as $admin) 
		{
		  $this->destroy($admin);	
		}
	}

	public function handleDataStore($request)
	{
		$data = $request->except('image']);


		if ( $request->hasFile('image') )
        {
            $data['image']    = $this->handleUpladImage('image','admins');
        }

        return $data;
	}


	public function handleDataUpdate($request,$admin)
	{
		$data = $request->except(,'image']);

 


        if ( $request->hasFile('image') )
        {
            $data['image'] = $this->handleUpladImage('image','admins',48,48,$admin->image);
        }

        return $data;

	}





	public static function handlePassword($password)
	{
		if ($password)
		{
			return bcrypt($password);
		}
	}


	public static function handleUpladImage($image,$folder,$width=48,$height=48,$oldImage=null)
	{
		if ( $image )
		{
			$path  = upload($image,$folder,$width,$height,$oldImage);
		}

		return $path;
	}


	public static function handleDeleteImage($img)
	{
		if ( Storage::has($img) && check_default($img) == 0 )
        {
            Storage::delete($img);
        }
	}


	public function handleMessages($type="success",$message=null)
	{   if ( is_null($message) )
		{
			$message = trans('dashboard.success_added');
		}
		return Toastr::$type($message);
		
	}




	public function getIndexRedirect()
    {
        
        return 'dashboard.admins.index';
    }

    


	



	
}