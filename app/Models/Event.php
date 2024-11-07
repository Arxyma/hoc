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
        'mentor_id',
        'user_id',
        'image',
        'tanggal_mulai',
        'tanggal_berakhir',
        'start_time',
        'kuota',
        'description',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date:m/d/Y', // Cast to date
        'tanggal_berakhir' => 'date:m/d/Y', // Cast to date
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
//     public function participants()
// {
//     return $this->belongsToMany(User::class, 'event_user')->withTimestamps();
// }
public function participants()
{
    return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
}
    public function users()
    {
    return $this->belongsToMany(User::class, 'event_user');
    }
}

