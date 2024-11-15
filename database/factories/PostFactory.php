<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        // Ambil semua nama file gambar dari folder 'images/'
        $images = File::files(public_path('images'));

        // Pilih gambar secara acak dari array gambar yang ditemukan
        $randomImage = $this->faker->randomElement($images);

        // Ambil nama file saja tanpa path lengkap
        $imageName = basename($randomImage);

        return [
            'content' => $this->faker->paragraphs(3, true), // Isi postingan berupa 3 paragraf acak
            'image' => 'images/' . $imageName, // Menyimpan nama file gambar dari folder 'images/'
            // 'user_id' dan 'community_id' tidak di-set di sini, diatur langsung dalam seeder
        ];
    }
}
