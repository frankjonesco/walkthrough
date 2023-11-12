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

    public function getImage($size = 'full'){

        if($size === 'full'){
            $image_name = $this->image;
        }else{
            $image_name = 'tn-'.$this->image;
        }


        if(!$this->image){
            return asset('images/no-image.webp');
        }
        elseif(file_exists(public_path('images/articles/'.$this->hex.'/'.$image_name))){
            return asset('images/articles/'.$this->hex.'/'.$image_name);
        }
        return asset('images/no-image.webp');
    }

    // Save image (update)
    public function saveImage($request){
        $image = new ImageProcess();
        $this->image = $image->upload($request, 'articles', $this);
        return $this;
    }

    // Save rendered image (update)
    public function saveRenderedImage($data){
        $image = new ImageProcess();
        $this->image = $image->renderCrop($data, 'articles', $this, 840, 472);
        return $this;
    }


}
