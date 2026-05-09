<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Itinerario de Viaje</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        .box { margin-bottom: 15px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>

<h1>Itinerario de Viaje</h1>

<div class="box">
    <span class="label">Cliente:</span>
    {{ $viaje->user->name }}
</div>

<div class="box">
    <span class="label">Destino:</span>
    {{ $viaje->destino->nombre }}
</div>

<div class="box">
    <span class="label">Hospedaje:</span>
    {{ $viaje->hospedaje->nombre }}
</div>

<div class="box">
    <span class="label">Transporte:</span>
    {{ $viaje->transporte ? $viaje->transporte->tipo . ' - ' . $viaje->transporte->placa : 'No seleccionado' }}
</div>

<div class="box">
    <span class="label">Fechas:</span>
    {{ $viaje->fecha_inicio }} al {{ $viaje->fecha_fin }}
</div>

<div class="box">
    <span class="label">Personas:</span>
    {{ $viaje->cantidad_personas }}
</div>

<div class="box">
    <span class="label">Tipo de viaje:</span>
    {{ $viaje->tipo_viaje }}
</div>

<div class="box">
    <span class="label">Precio total:</span>
    ${{ number_format($viaje->precio_total, 2) }}
</div>

</body>
</html>