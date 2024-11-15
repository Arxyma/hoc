<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Promosi;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromosiFactory extends Factory
{
    protected $model = Promosi::class;

    public function definition()
    {
        // Ambil semua nama file gambar dari folder 'images/'
        $images = File::files(public_path('images'));

        // Pilih 2 gambar secara acak dari array gambar yang ditemukan
        $selectedImages = $this->faker->randomElements($images, min(count($images), 2));

        // Ambil nama file saja tanpa path lengkap
        $foto_produk = array_map(fn($file) => 'images/' . basename($file), $selectedImages);

        return [
            'judul' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'deskripsi' => $this->faker->paragraph,
            'foto_produk' => json_encode($foto_produk), // Simpan dalam format JSON
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved']),
        ];
    }
}
