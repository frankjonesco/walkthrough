<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CategoryFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hex = Str::random(11);
        $directory = public_path('images/categories/'.$hex);
        File::makeDirectory($directory, 0777, true, true);

        $url = "https://random.imagecdn.app/500/300";
        $info = pathinfo($url);
        $contents = file_get_contents($url);
        
        $random_image_name = Str::random(11).'.webp';
        $file = public_path('images/categories/'.$hex.'/' . $random_image_name);
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $info['basename']);
        File::copy($file, $directory.'/tn-'.$random_image_name);
        
        return [
            'hex' => $hex,
            'user_id' => User::all()->random()->id,
            'name' => ucfirst(fake()->word()),
            'description' => fake()->sentence(12),
            'image' => $random_image_name,
            'status' => 'public'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
