<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'author',
        'genre',
        'publication',
        'amount_words_book',
        'price',
    ];
}
