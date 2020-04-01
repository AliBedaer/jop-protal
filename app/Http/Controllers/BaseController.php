<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Toastr;

class BaseController extends Controller
{
	public function handleDestroy($id,$modelClass,$serviceClass,$img=null)
	{
		if ( is_array($id) )
        {

            $objects = $modelClass::whereIn('id',$id)->get();

            foreach ( $objects as $obj )
            {
                self::handleDestroy($obj->id,$modelClass,$serviceClass,$img=null);
            }

        } else {

            $obj = $modelClass::findorFail($id);
            $serviceClass::handleDeleteImage($obj->$img);
            $obj->delete();
            Toastr::success(trans('dashboard.success_delete'));

        }
	}


}