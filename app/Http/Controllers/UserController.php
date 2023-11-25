<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $site;
    
    public function __construct(){
        $this->site = new Site();
    }

    // SHOW LOGIN FORM
    public function viewLoginForm(){
        return view('users.login', [
            'page_headings' => pageHeadings('Log in', 'Log in to your account')
        ]);
    }
    

    // AUTHENTICATE USER FOR LOGIN
    public function authenticate(Request $request){
        // Validate form fields
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Authenticate login and go to dashboard
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('dashboard')->with('message', 'You have logged in!');
        }
        // Or return to login form with error
        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }


    // SHOW REGISTRATION FORM
    public function viewRegistrationForm(){
        return view('users.registration', [
            'page_headings' => pageHeadings('Sign up', 'Register for an account on '.config('app.name'))
        ]);
    }


    // STORE NEW USER IN DATABASE
    public function store(Request $request){
        // Validate form fields
        $formFields = $request->validate([
           'first_name' => ['required', 'min:2', 'max:25'],
           'last_name' => ['required', 'min:2', 'max:25'],
           'email' => ['required', 'email', Rule::unique('users', 'email')],
           'password' => ['required', 'confirmed', 'min:8'],
        ]);
        // Create user and insert to database
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
        // Authenticate login and go to dashboard
        auth()->login($user);
        return redirect('dashboard')->with('message', 'Your account has been created!');
   }


    // LOG USER OUT
    public function logout(Request $request){
        // Log nuser out and destroy session 
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Return to homepage with confirmation message
        return redirect('/')->with('message', 'You have been logged out.');
    }


    // SHOW PROFILE
    public function showProfile(){
        return view('users.profile', [
            'page_headings' => pageHeadings('Profile', 'Your user profile on '.config('app.name')),
            'user' => $this->site->loggedInUser()
        ]);
    }


    // VIEW EDIT PROFILE FORM
    public function viewEditProfileForm(){
        return view('users.edit-profile', [
            'page_headings' => pageHeadings('Edit profile', 'Update the information in your profile and click Save changes.'),
            'user' => $this->site->loggedInUser()
        ]);
    }


    // UPDATE PROFILE
    public function updateProfile(Request $request){
        // Validate form fields
        $formFields = $request->validate([
            'first_name' => 'required|min:2|max:20',
            'last_name' => 'required|min:2|max:20',
            'email' => ['required', 'email', 'unique:users,email,' .auth()->user()->id]
        ]);
        // Update user fields and sve to database
        $user = $this->site->loggedInUser();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();
        // Return to profile with confirmation
        return redirect('profile')->with('message', 'Profile updated!');
    }


    // VIEW EDIT PASSWORD FORM
    public function viewEditPasswordForm(){
        $user = $this->site->loggedInUser();
        return view('users.edit-password', [
            'page_headings' => pageHeadings('Change password', 'Update you password and click Save password.'),
            'user' => $user
        ]);
    }


    // UPDATE PASSWORD
    public function updatePassword(Request $request){
        // Validate for fields
        $formFields = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
        // Validate old password or return with error
        $user = $this->site->loggedInUser();
        if(Hash::check($request->old_password, $user->password) === false){
            return back()->withErrors(["old_password" => "Incorrect password"]);
        }
        // Encrypt new password and save to database
        $user->password = bcrypt($request->password);
        $user->save();
        // Return to profile with confirmation
        return redirect('profile')->with('message', 'Password updated!');
    }


    // VIEW EDIT PROFILE IMAGE FORM
    public function viewEditProfileImageForm(){
        return view('users.edit-image', [
            'page_headings' => pageHeadings('Edit profile picture', 'Browse you device for the image you want tot use.')
        ]);
    }


    // UPLOAD PROFILE IMAGE
    public function uploadImage(Request $request){
        // Validate image parameters
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);
        // Save image to user directory
        if($request->hasFile('image'))
            $this->site->saveImage($request, $this->site->loggedInUser(), 'users');
        // Forward to image cropper
        return redirect('profile/image/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }


    // VIEW CROP IMAGE FORM
    public function viewCropImageForm(){
        return view('users.image-crop', [
            'page_headings' => pageHeadings('Crop profile picture', 'Drag the pointer across the image to crop.'),
            'user' => $this->site->loggedInUser()
        ]);
    }


    // RENDER IMAGE
    public function renderImage(Request $request){
        // Validate cropper dimensions/coordinates
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);
        // Save cropped image to user directory
        $this->site->loggedInUser()->saveRenderedImage($data);
        // Return to profile with confirmation
        return redirect('profile')->with('message', 'Profile picture updated!');
    }
}
