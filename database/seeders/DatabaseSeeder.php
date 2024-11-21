<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Berita;
use App\Models\Mentor;
use App\Models\Comment;
use App\Models\Promosi;
use App\Models\Community;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat pengguna khusus admin dan level2
        $admin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'role_name' => 'admin',
            'password' => bcrypt('admin')
        ]);

        $level2 = User::factory()->create([
            'name' => 'Test Level2',
            'email' => 'level2@example.com',
            'role_name' => 'level2',
            'password' => bcrypt('level2')
        ]);

        $pimpinan = User::factory()->create([
            'name' => 'Test Pimpinan',
            'email' => 'pimpinan@example.com',
            'role_name' => 'pimpinan',
            'password' => bcrypt('pimpinan')
        ]);

        // Buat pengguna umum lainnya
        $users = User::factory(18)->create();

        // Buat komunitas, mentor, dan post awal
        $existingCommunity = Community::factory(10)->create();
        $existingMentor = Mentor::factory(5)->create();

        // Buat acara terkait mentor
        Event::factory(5)->create([
            'mentor_id' => $existingMentor->random()->id,
            'user_id' => $users->random()->id,
        ]);

        // Buat post dan comment dengan user yang berbeda
        Post::factory(20)->create([
            'user_id' => $users->random()->id, // Pilih user acak dari user factory
            'community_id' => $existingCommunity->random()->id,
        ]);

        Comment::factory(40)->create([
            'post_id' => Post::inRandomOrder()->first()->id, // Pilih post acak
            'user_id' => $users->random()->id, // Pilih user acak dari user factory
        ]);

        // Buat berita dan promosi terkait user acak
        Berita::factory(20)->create();
        Promosi::factory(20)->create([
            'user_id' => $users->random()->id,
        ]);
    }
}
