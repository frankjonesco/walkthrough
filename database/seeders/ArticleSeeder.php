<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // IMPORT FROM FACTORY
        File::cleanDirectory('public/images/articles');
        Article::factory()->count(60)->create();

        // IMPORT FROM DATATBASE
        // $model = new Article();
        
        // $items = $model::on('mysql_import')->get();

        // foreach($items as $item){
        //     $model::create([
        //         'id' => $item->id,
        //         'hex' => $item->hex,
        //         'user_id' => $item->user_id,
        //         'title' => $item->title,
        //         'caption' => $item->caption,
        //         'body' => $item->body,
        //         'tags' => $item->tags,
        //         'image' => $item->image,
        //         'image_caption' => $item->image_caption,
        //         'image_copyright' => $item->image_copyright,
        //         'views' => $item->views,                
        //         'created_at' => $item->created_at,
        //         'updated_at' => $item->updated_at,
        //         'status' => $item->status
        //     ]);
        // }
    }
}
