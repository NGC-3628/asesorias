<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'rol'
    ];

    public function heroes(){
        return $this->belongsToMany(Hero::class);
    }
}
