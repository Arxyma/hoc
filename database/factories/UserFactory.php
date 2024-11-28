<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $name = $this->faker->name;
        $phoneNumber = $this->faker->numerify('62###########'); // Membuat nomor telepon tanpa spasi atau kurung dan maksimal 15 karakter

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail,
            'role_name' => $this->faker->randomElement(['level1', 'level2']),
            'password' => bcrypt('password'), // Ganti dengan password yang sesuai
            'usia' => $this->faker->numberBetween(18, 65),
            'alamat' => $this->faker->address,
            'no_telp' => $phoneNumber,
            'domisili' => $this->faker->city,
            'status_usaha' => $this->faker->randomElement(['aktif', 'non-aktif']),
            'jenis_usaha' => $this->faker->word,
            'foto_profil' => 'images/default-profile.png', // Atau gunakan gambar acak
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
