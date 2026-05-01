<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nombre', 'capacidad', 'tipo', 'direccion', 'imagenes'])]

class Hospedaje extends Model
{
    use SoftDeletes;
    //

    public function destinos()
    {
        return $this->belongsToMany(Destino::class, 'destino_hospedajes');
    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
