<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['modelo', 'placa', 'capacidad','tipo','activo'])]
class Transporte extends Model
{
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'capacidad' => 'integer',
        ];
    }


    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}