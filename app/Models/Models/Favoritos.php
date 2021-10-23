<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model {

    use HasFactory;

    protected $table = 'favoritos';
    protected $fillable = [
        'user_id',
        'meus_quadrinhos_id',
    ];

    public function user() {
        return $this->belongsTo('App/Models/User');
    }

    public function favoritos() {
        return $this->belongsTo('App/Models/models/Favoritos');
    }

}
