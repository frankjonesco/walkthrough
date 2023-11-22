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
        'category_id',
        'title',
        'slug',
        'caption',
        'body',
        'tags',
        'image',
        'image_caption',
        'image_copyright',
        'image_caption',
        'image_copyright',
        'image_copyright_link',
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

    // Relationship to category
    public function category(){
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'General',
      ]);
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

    // Split tags
    public function splitTags(){
        return explode(',', $this->tags);
    }


    // Highlight search term
    public static function highlightSearchTerm(string $search_term = null, Article $article = null){
        $case_variants = [
            $search_term,
            strtolower($search_term),
            strtoupper($search_term),
            ucfirst($search_term),
        ];
        foreach($case_variants as $case_variant){
            $highlighted_text = '<span class="bg-yellow-200 py-0.5 px-1.5 inline-block">'.$case_variant.'</span>';
            $article->title = str_replace($case_variant, $highlighted_text, $article->title);
            $article->tags = str_replace(strtolower($search_term), '<span class="font-bold">'.strtolower($search_term).'</span>', $article->tags);
        }
        return $article;
    }







    public function fetch(string $status = 'any'){
        if($status === 'public')
            return Article::where('id', $this->id)->where('status', 'public')->first();
        if($status === 'private')
            return Article::where('id', $this->id)->where('status', 'private')->first();
        if($status === 'any')
            return Article::where('id', $this->id)->first();
        return false;
    }


    public function addView(){
        $this->views = $this->views + 1;
        $this->save();
    }

    public function metadata(){
        return [
            'title' => $this->title.' | '.config('app.name'),
            'description' => $this->caption,
            'keywords' => $this->tags
        ];
    }


}
