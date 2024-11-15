<?php

namespace Database\Factories;

use App\Models\Mentor;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class MentorFactory extends Factory
{
    protected $model = Mentor::class;

    public function definition()
    {
        // Ambil semua nama file gambar dari folder 'images/'
        $images = File::files(public_path('images'));

        // Pilih gambar secara acak dari array gambar yang ditemukan
        $randomImage = $this->faker->randomElement($images);

        // Ambil nama file saja tanpa path lengkap
        $imageName = basename($randomImage);


        return [
            'name' => $this->faker->name,
            'image' => 'images/' . $imageName,
        ];
    }
}
