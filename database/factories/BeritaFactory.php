<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeritaFactory extends Factory
{
    protected $model = Berita::class;

    public function definition()
    {
        // Ambil semua nama file gambar dari folder 'images/'
        $images = File::files(public_path('images'));

        // Pilih gambar secara acak dari array gambar yang ditemukan
        $randomImage = $this->faker->randomElement($images);

        // Ambil nama file saja tanpa path lengkap
        $imageName = basename($randomImage);

        $judul = $this->faker->sentence(5); // Judul acak dengan 5 kata

        return [
            'judul' => $judul,
            'slug' => Str::slug($judul), // Slug berdasarkan judul
            'isi_berita' => $this->faker->paragraphs(3, true), // Isi berita dengan 3 paragraf acak
            'gambar' => 'images/' . $imageName,
        ];
    }
}
