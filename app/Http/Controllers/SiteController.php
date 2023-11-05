<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Show homepage
    public function showHome(){
        return view('home');
    }
}
