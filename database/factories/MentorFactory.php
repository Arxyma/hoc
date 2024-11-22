<?php

namespace Database\Factories;

use App\Models\Event;
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

    /**
     * Tambahkan event untuk mentor (relasi event_mentor)
     */
    public function withEvents(int $count = 3)
    {
        return $this->afterCreating(function (Mentor $mentor) use ($count) {
            // Ambil event secara acak atau buat baru
            $events = Event::inRandomOrder()->limit($count)->pluck('id');

            if ($events->isEmpty()) {
                $events = Event::factory()->count($count)->create()->pluck('id');
            }

            // Hubungkan mentor dengan event
            $mentor->events()->attach($events);
        });
    }
}