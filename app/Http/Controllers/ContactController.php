<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
    	$table = Contact::all();
    	//dd($table);


    	return view('contact/index');
    }

    public function create()
    {
    	return view('contact/create');
    }
}
