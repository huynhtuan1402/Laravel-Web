<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact_us(){
        return view('pages.contact_us');
    }
}
