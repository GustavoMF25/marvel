<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quadrinhos extends Model {

    use HasFactory;

    protected $table = 'quadrinhos';
    
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
