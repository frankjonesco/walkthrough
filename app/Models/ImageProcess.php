<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageProcess extends Model
{
    use HasFactory;

    // Upload image
    public function upload($request, $target, $item){
        $image_name = Str::random('6').'-'.time().'.webp';
        $directory_path = public_path('images/'.$target.'/'.$item->hex);
        $request->file('image')->move($directory_path, $image_name);
        self::encode($directory_path, $image_name);
        // self::deleteOtherFiles($directory_path, $image_name);
        self::saveToDatabase($item, $image_name);
        // self::batchSizes(Image::make($directory_path.'/'.$image_name), 480, $directory_path, $image_name);
        return true;
    }

    // Encode image
    public function encode($directory_path, $image_name){
        $img = Image::make($directory_path.'/'.$image_name)->encode('webp');
        $img->save($directory_path.'/'.$image_name, 80);
        return true;
    }

    // Delete other files
    public function deleteOtherFiles($directory_path, $image_name){
        $files_in_folder = File::allFiles($directory_path);
        foreach($files_in_folder as $key => $path){
            if($path != $directory_path.'/'.$image_name){
                File::delete($path);
            }
        }
        return true;
    }

    // Save to database
    public function saveToDatabase($item, $image_name){
        $item->image = $image_name;
        $item->save();
        return true;
    }

    // Batch sizes
    public function batchSizes($img, $full_size, $directory_path, $image_name){
        // $img->resize(null, $full_size, function ($constraint){ 
        //     $constraint->aspectRatio(); 
        // })
        // ->save($directory_path.'/lg-'.$image_name, 100);

        $img->resize(null, 199, function ($constraint){ 
            $constraint->aspectRatio(); 
        })
        ->save($directory_path.'/tn-'.$image_name, 100);

        return true;
    }

    // Render crop
    public function renderCrop($data, $target, $item, $width = 760, $height = 428){// Round crop parameter to integer value
        $w = round($data['w']);
        $h = round($data['h']);
        $x = round($data['x']);
        $y = round($data['y']);
    
        // Open file as image resource
        $img = Image::make(public_path('images/'.$target.'/'.$item->hex.'/'.$item->image));
        
        // Crop image
        $img->crop($w,$h,$x,$y);
        
        // Save full size image
        $img->resize($width, $height);
        $img->save('images/'.$target.'/'.$item->hex.'/'.$item->image, 100);
        
        self::batchSizes($img, $height, public_path('images/'.$target.'/'.$item->hex), $item->image);
    }


}
