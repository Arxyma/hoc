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
        // Ambil semua nama file gambar dari folder 'images/'
        $images = File::files(public_path('images'));

        // Pilih gambar secara acak dari array gambar yang ditemukan
        $randomImage = $this->faker->randomElement($images);

        // Ambil nama file saja tanpa path lengkap
        $imageName = basename($randomImage);

        return [
            'name' => $this->faker->unique()->company, // Nama komunitas acak
            'description' => $this->faker->paragraph, // Deskripsi komunitas acak
            'thumbnail' => 'images/' . $imageName, // Menyimpan nama file gambar dari folder 'images/'
        ];
    }
}
