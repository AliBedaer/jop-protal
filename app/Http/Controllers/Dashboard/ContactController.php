<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
    	return view('dashboard.contacts.index',[
    		'title'    => 'Contacts Control',
    		'contacts' => Contact::latest()->paginate(5)
    	]);
    }


    public function readNotofocations()
    {
    	auth_admin()->unreadNotifications->markAsRead();

    	return response('done!');
    }
}
