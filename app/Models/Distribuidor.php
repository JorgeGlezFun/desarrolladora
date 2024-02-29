<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    use HasFactory;

    protected $table='distribuidoras';

    protected $fillable = [
        'nombre',
    ];

    use HasFactory;

    public function desarrolladora(){
        return $this->belongsTo(Desarrolladora::class);
    }
}
