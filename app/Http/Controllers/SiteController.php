<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Show homepage
    public function showHome(){
        return view('home');
    }

    // Show about
    public function showAbout(){
        return view('about');
    }

    // Show posts
    public function showPosts(){
        return view('posts');
    }

    // Show contact
    public function showContact(){
        return view('contact');
    }
}
