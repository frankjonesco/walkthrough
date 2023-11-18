<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ArticleFactory extends Factory
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
        $directory = 'public/images/articles/'.$hex;
        File::makeDirectory($directory, 0777, true, true);

        $url = "https://random.imagecdn.app/816/459";
        $info = pathinfo($url);
        $contents = file_get_contents($url);
        
        $random_image_name = Str::random(11).'.webp';
        $file = public_path('images/articles/'.$hex.'/' . $random_image_name);
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $info['basename']);
        File::copy($file, $directory.'/tn-'.$random_image_name);

        return [
            'hex' => $hex,
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'title' => fake()->sentence(),
            'caption' => fake()->sentence(),
            'body' => '<p>'.fake()->paragraph(5).'</p><p>'.fake()->paragraph(7).'</p>',
            'tags' => fake()->word().', '.fake()->word().', '.fake()->word(),
            'image' => $random_image_name,
            'views' => fake()->biasedNumberBetween(1000,100000),
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
