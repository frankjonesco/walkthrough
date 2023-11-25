<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hex',
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type_id',
        'image',
        'gender'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    // HELPER FUNCTIONS

    // Logged in user

    public function loggedInUser(){
        return User::where('id', auth()->user->id)->first();
    }

    // Get full name
    public function fullName(){
        return $this->first_name.' '.$this->last_name;
    }

    // Get image
    public function getImage($size = 'full'){

        if($size === 'full'){
            $image_name = $this->image;
        }else{
            $image_name = 'tn-'.$this->image;
        }

        if(!$this->image){
            return asset('images/default-profile-pic.webp');
        }
        elseif(file_exists(public_path('images/users/'.$this->hex.'/'.$image_name))){
            return asset('images/users/'.$this->hex.'/'.$image_name);
        }
        return asset('images/default-profile-pic.webp');
    }

    // Save image (update)
    public function saveImage($request){
        $image = new ImageProcess();
        $this->image = $image->upload($request, 'users', $this);
        return $this;
    }

    // Save rendered image (update)
    public function saveRenderedImage($data){
        $image = new ImageProcess();
        $this->image = $image->renderCrop($data, 'users', $this, 568, 568);
        return $this;
    }
}
