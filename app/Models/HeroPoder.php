<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroPoder extends Model
{
    protected $table = "hero_poder";
    protected $fillable = [
        "id",
        "hero_id",
        "poder_id"
    ];
}
