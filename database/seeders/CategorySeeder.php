<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // IMPORT FROM FACTORY
        File::cleanDirectory('public/images/categories');
        Category::factory()->count(15)->create();

        // IMPORT FROM DATATBASE
        // $model = new Category();
        
        // $items = $model::on('mysql_import')->get();

        // foreach($items as $item){
        //     $model::create([
        //         'id' => $item->id,
        //         'hex' => $item->hex,
        //         'user_id' => $item->user_id,
        //         'name' => $item->name,
        //         'description' => $item->description,
        //         'image' => $item->image,          
        //         'created_at' => $item->created_at,
        //         'updated_at' => $item->updated_at,
        //         'status' => $item->status
        //     ]);
        // }
    }
}
