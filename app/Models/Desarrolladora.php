<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desarrolladora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    use HasFactory;

    public function distribuidoras(){
        return $this->hasMany(Distribuidor::class);
    }

    public function videojuegos(){
        return $this->hasMany(Videojuego::class);
    }
}
