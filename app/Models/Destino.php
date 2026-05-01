<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nombre', 'ciudad', 'pais', 'direccion', 'imagenes'])]
class Destino extends Model
{
    use SoftDeletes;
    //

    public function hospedajes()
    {
        return $this->belongsToMany(Hospedaje::class, 'destino_hospedajes');
    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
