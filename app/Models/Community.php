<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;  // Pastikan trait ini ada

    protected $fillable = ['name', 'description', 'thumbnail'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
