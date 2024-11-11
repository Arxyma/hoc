<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    /** @use HasFactory<\Database\Factories\PromosiFactory> */
    use HasFactory;
    protected $table = 'promosis';

    protected $fillable =[
        'id',
        'judul',
        'slug',
        'deskripsi',
        'foto_produk',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];

    // untuk relasi ke table user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
