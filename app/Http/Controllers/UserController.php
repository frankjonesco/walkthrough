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

    // View profile
    public function showProfile(){
        $user = User::where('id', auth()->user()->id)->first();
        return view('users.profile', [
            'user' => $user
        ]);
    }

    // Edit profile
    public function editProfile(){
        $user = User::where('id', auth()->user()->id)->first();
        return view('users.edit-profile', [
            'user' => $user
        ]);
    }

    // Update profile
    public function updateProfile(Request $request){

        $formFields = $request->validate([
            'first_name' => 'required|min:2|max:20',
            'last_name' => 'required|min:2|max:20',
            'email' => ['required', 'email', 'unique:users,email,' .auth()->user()->id]
        ]);

        $user = User::where('id',auth()->user()->id)->first();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        $user->save();

        return redirect('profile')->with('message', 'Profile updated!');
    }
}
