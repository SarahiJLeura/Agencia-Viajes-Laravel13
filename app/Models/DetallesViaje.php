<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['viaje_id', 'concepto', 'costo'])]
class DetallesViaje extends Model
{
    use SoftDeletes;
    //
    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }
}
