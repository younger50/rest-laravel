<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // fields
    protected $fillable = [
        'user_id', 'title', 'description'
    ];

    // book user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // book rating
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
