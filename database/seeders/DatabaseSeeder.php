<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $model = new User();
        
        $model::create([
            'hex' => Str::random(11),
            'first_name' => 'Chandler',
            'last_name' => 'Bing',
            'email' => 'c.bing@gmail.com',
            'email_verified_at' => time(),
            'password' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        
    }
}
