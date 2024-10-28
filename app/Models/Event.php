<?php

namespace App\Models;

use App\Models\Mentor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_event',
        'kuota',
        'description',
        'tanggal',
        'start_time',
        'image',
        'user_id',
        'mentor_id'
    ];

    protected $casts = [
        'tanggal' => 'date:m/d/Y', // Cast to date
        'start_time' => 'datetime:H:i', // Hanya ambil jam dan menit
    ];

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
    return $this->belongsToMany(User::class, 'event_user');
    }
    public function users()
    {
    return $this->belongsToMany(User::class, 'event_user');
    }
}
