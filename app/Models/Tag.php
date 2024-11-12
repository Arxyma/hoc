<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // public function events()
    // {
    //     return $this->belongsToMany(Event::class);
    // }
    public function events()
{
    return $this->belongsToMany(Event::class, 'event_tag');
}

}
