<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    // fields
    protected $fillable = [
        'book_id', 'user_id', 'rating'
    ];

    // rating book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
