<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Mentor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_event',
        'slug',
        'mentor_id',
        'user_id',
        'image',
        'tanggal_mulai',
        'tanggal_berakhir',
        'start_time',
        'kuota',
        'description',
        'tag'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date:m/d/Y', // Cast to date
        'tanggal_berakhir' => 'date:m/d/Y', // Cast to date
        'start_time' => 'datetime:H:i', // Hanya ambil jam dan menit
    ];

    public function setNamaEventAttribute($value)
    {
        $this->attributes['nama_event'] = $value;
        // Isi slug jika belum ada
        $this->attributes['slug'] = $this->attributes['slug'] ?? Str::slug($value);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tag');
    }
}
