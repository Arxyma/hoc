<?php

namespace Database\Factories;

use App\Models\Community;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class CommunityFactory extends Factory
{
    protected $model = Community::class;

    public function definition()
    {
        $images = File::files(public_path('images'));

        $imagePath = 'images/default-profile.png'; // Path relatif
        if (count($images) > 0) {
            $randomImage = $this->faker->randomElement($images);
            $imagePath = 'images/' . basename($randomImage);
        }

        return [
            'name' => $this->faker->unique()->company,
            'description' => $this->faker->paragraph,
            'thumbnail' => $imagePath,
            'jml_anggota' => $this->faker->optional()->numberBetween(1, 500), // Angka acak untuk anggota
        ];
    }
}
