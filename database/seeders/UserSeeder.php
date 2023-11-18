<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {      
        // IMPORT FROM FACTORY
        File::cleanDirectory('public/images/users');
        User::factory()->count(12)->create();

        // IMPORT FROM DATATBASE
        // $model = new User();
        
        // $items = $model::on('mysql_import')->get();

        // foreach($items as $item){
        //     $model::create([
        //         'id' => $item->id,
        //         'hex' => $item->hex,
        //         'first_name' => $item->first_name,
        //         'last_name' => $item->last_name,
        //         'email' => $item->email,
        //         'email_verified_at' => $item->email_verified_at,
        //         'password' => $item->password,
        //         'image' => $item->password,
        //         'gender' => $item->gender,
        //         'remember_token' => $item->remember_token,
        //         'created_at' => $item->created_at,
        //         'updated_at' => $item->updated_at,
        //     ]);
        // }
        
    }
}
