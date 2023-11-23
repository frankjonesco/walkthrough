<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show login form
    public function viewLoginForm(){
        return view('users.login');
    }

    // Show registration form
    public function viewRegistrationForm(){
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
           'password' => bcrypt($request->password),
           'gender' => $request->gender,
           'user_type_id' => 1,
           'remember_token' => Str::random(10)
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

        $user = User::where('id', auth()->user()->id)->first();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        $user->save();

        return redirect('profile')->with('message', 'Profile updated!');
    }

    // Edit password
    public function editPassword(){
        $user = User::where('id', auth()->user()->id)->first();
        return view('users.edit-password', [
            'user' => $user
        ]);
    }

    // Update password
    public function updatePassword(Request $request){
        $formFields = $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed'
        ]);
        if(Hash::check($request->old_password, auth()->user()->password) === false){
            return back()->withErrors(["old_password" => "Incorrect password"]);
        }
        $user = User::where('id', auth()->user()->id)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('profile')->with('message', 'Password updated!');
    }

    // Edit image
    public function editImage(){
        return view('users.edit-image');
    }

    // Upload image
    public function uploadImage(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        if($request->hasFile('image')){
            $user->saveImage($request);
        }
        
        return redirect('profile/image/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(){
        return view('users.image-crop', [
            'user' => User::where('id', auth()->user()->id)->first()
        ]);
    }

    // Render image
    public function renderImage(Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        $user->saveRenderedImage($data);

        return redirect('profile')->with('message', 'Profile picture updated!');
    }
}
