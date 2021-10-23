<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeusQuadrinhos extends Model {

    use HasFactory;

    protected $table = 'meus_quadrinhos';
    protected $fillable = [
        'user_id',
        'idComics',
        'title',
        'description',
        'url',
        'thumbnail',
        'ean',
        'prices',
        'images',
    ];

    public function user() {
        return $this->belongsTo('App/Models/User');
    }

    

}
