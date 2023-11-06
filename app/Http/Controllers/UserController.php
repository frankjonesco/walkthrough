<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show login form
    public function showLoginForm(){
        return view('users.login');
    }

    // Show registration form
    public function showRegistrationForm(){
        return view('users.registration');
    }
}
