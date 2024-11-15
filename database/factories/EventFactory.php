<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        // Ambil semua nama file gambar dari folder 'images/'
        $images = File::files(public_path('images'));

        // Pilih gambar secara acak dari array gambar yang ditemukan
        $randomImage = $this->faker->randomElement($images);

        // Ambil nama file saja tanpa path lengkap
        $imageName = basename($randomImage);

        $namaEvent = $this->faker->sentence(3);
        $tanggalMulai = Carbon::parse($this->faker->dateTimeBetween('-1 month', '+1 month'));
        $tanggalBerakhir = (clone $tanggalMulai)->addDays(rand(1, 5));
        $startTime = $this->faker->time('H:i');

        return [
            'nama_event' => $namaEvent,
            'slug' => Str::slug($namaEvent),
            // 'mentor_id' dan 'user_id' akan diatur secara manual dalam seeder
            'image' => 'images/' . $imageName,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_berakhir' => $tanggalBerakhir,
            'start_time' => $startTime,
            'kuota' => $this->faker->numberBetween(10, 100),
            'description' => $this->faker->paragraph,
            'tag' => $this->faker->word,
        ];
    }
}
