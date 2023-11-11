<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hex',
        'user_id',
        'title',
        'caption',
        'body',
        'image',
        'views',
        'status'
    ];



    // ROUTES
    
    // Set the route key name
    public function getRouteKeyName(){
        return 'hex';
    }



    // RELATIONAL MAPPING

    // Relationship to user
    public function user(){
        return $this->belongsTo(User::class);
    }



    
    // HELPER FUNCTIONS

    // Get image

    public function getImage(){
        if(!$this->image){
            return asset('images/no-image.webp');
        }
        elseif(file_exists(public_path('images/articles/'.$this->hex.'/'.$this->image))){
            return asset('images/articles/'.$this->hex.'/'.$this->image);
        }
        return asset('images/no-image.webp');
    }


}
