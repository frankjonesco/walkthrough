<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    // Store new user
    public function store(Request $request){

        $formFields = $request->validate([
           'first_name' => ['required', 'min:2', 'max:25'],
           'last_name' => ['required', 'min:2', 'max:25'],
           'email' => ['required', 'email', Rule::unique('users', 'email')],
           'password' => ['required', 'confirmed', 'min:8'],
        ]);

       // Create user
       $user = User::create([
           'hex' => Str::random(11),
           'first_name' => trim($request->first_name),
           'last_name' => trim($request->last_name),
           'email' => trim($request->email),
           'password' => bcrypt($request->password)
       ]);

        // Login
        auth()->login($user);

        return redirect('/dashboard')->with('message', 'Your account has been created!');
   }

    // Log user out
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    // Authenticate user for login
    public function authenticate(Request $request){

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/dashboard')->with('message', 'You have logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    // View Dashboard
    public function viewDashboard(){
        return view('users.dashboard');
    }
}
