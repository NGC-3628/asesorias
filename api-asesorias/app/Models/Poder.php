<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poder extends Model
{
    protected $table = "poderes";
    protected $fillable = [
        "id",
        "nombre",
        "descripcion"
    ];

    function heroes(){
        return $this->belongsToMany(Hero::class, 'hero_poder');
    }
}
