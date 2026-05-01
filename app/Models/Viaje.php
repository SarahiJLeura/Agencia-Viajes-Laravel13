<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'destino_id', 'hospedaje_id', 'transporte_id', 'fecha_inicio','fecha_fin','cantidad_personas','tipo_viaje', 'precio_total'])]
class Viaje extends Model
{
    use SoftDeletes;
    //
    protected function casts(): array{
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }

    public function hospedaje()
    {
        return $this->belongsTo(Hospedaje::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetallesViaje::class);
    }

    public function transporte()
    {
        return $this->belongsTo(Transporte::class);
    } 
}
