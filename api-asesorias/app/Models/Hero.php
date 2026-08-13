<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Poder;
use App\Models\Rol;


class Hero extends Model
{
    protected $table = 'heroes';
    protected $fillable = [
        'nombre', 
        'vida', 
        'habilidad',
        'rol_id'
        ];

        public function poderes()
        {
            return $this->belongsToMany(Poder::class, 'hero_poder');
        }

        public function rol(){
            return $this->belongsTo(Rol::class);
        }
}
