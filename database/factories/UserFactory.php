<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
        $directory = public_path('images/users/'.$hex);
        File::makeDirectory($directory, 0777, true, true);

        $genders = ['male', 'female'];
        $gender = array_rand($genders);

        $url = "https://xsgames.co/randomusers/avatar.php?g=".$genders[$gender];
        $info = pathinfo($url);
        $contents = file_get_contents($url);
        
        $random_image_name = time().'.webp';
        $file = public_path('/images/users/'.$hex.'/' . $random_image_name);
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $info['basename']);
        File::copy($file, $directory.'/tn-'.$random_image_name);

        return [
            'hex' => $hex,
            'first_name' => $gender === 'female' ? fake()->firstNameFemale() : fake()->firstNameMale(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'image' => $random_image_name,
            'gender' => $gender
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
