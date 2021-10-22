<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guadrinhos extends Model {

    use HasFactory;

    protected $table = 'guadrinhos';
    
    protected $fillable = [
        'idComics',
        'title',
        'description',
        'url',
        'thumbnail',
        'ean',
        'prices',
        'images',
    ];
}
