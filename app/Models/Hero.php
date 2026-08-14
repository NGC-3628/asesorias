<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $table = 'heroes';

    protected $fillable = [
        'nombre',
        'vida',
        'habilidad',
        'rol_id',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function poderes()
    {
        return $this->belongsToMany(Poder::class, 'hero_poder', 'hero_id', 'poder_id');
    }
}