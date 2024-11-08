<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Event;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_name',
        'password',
        'usia',         // Tambahkan field usia
        'alamat',       // Tambahkan field alamat
        'no_telp',      // Tambahkan field no_telp
        'domisili',     // Tambahkan field domisili
        'status_usaha', // Tambahkan field status_usaha
        'jenis_usaha',  // Tambahkan field jenis_usaha
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function joinedEvents()
    // {
    //     return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id')
    //         ->withTimestamps(); // Nama pivot table 'event_user'
    // }
    public function joinedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id');
    }
    // public function events()
    // {
    //     return $this->belongsToMany(Event::class, 'event_user');
    // }
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id');
    }

    public function hasRole($role_name)
    {
        return $this->role_name === $role_name;
    }

    // relasi ke table promosi
    public function promosis()
    {
        return $this->hasMany(Promosi::class);
    }

}
