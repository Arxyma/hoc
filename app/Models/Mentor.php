<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
