<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            // 'post_id' dan 'user_id' akan diatur secara manual dalam seeder
            'content' => $this->faker->sentence(), // Isi komentar berupa kalimat acak
        ];
    }
}
