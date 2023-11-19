<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_types = [
            [
                'id' => 1,
                'name' => 'Registered',
            ],
            [
                'id' => 2,
                'name' => 'Publisher',
            ],
            [
                'id' => 3,
                'name' => 'Administrator',
            ],
            [
                'id' => 4,
                'name' => 'Super Administrator',
            ]
        ];

        $model = new UserType();
        foreach($user_types as $user_type){
            $model::create($user_type);
        }

    }
}
