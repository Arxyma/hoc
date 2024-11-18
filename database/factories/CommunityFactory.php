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
        // Ambil semua file dari folder 'public/images'
        $images = File::files(public_path('images'));

        // Jika folder kosong, gunakan default gambar
        $imagePath = 'images/default-profile.png'; // Path relatif
        if (count($images) > 0) {
            // Pilih gambar secara acak dari folder
            $randomImage = $this->faker->randomElement($images);
            $imagePath = 'images/' . basename($randomImage); // Path relatif
        }

        return [
            'name' => $this->faker->unique()->company,
            'description' => $this->faker->paragraph,
            'thumbnail' => $imagePath, // Simpan path relatif
        ];
    }
}
