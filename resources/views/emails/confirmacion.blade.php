<x-mail::message>
# Introducción

Gracias {{ $user->name }} por hacer la reservación con nosotros.

A continuación se desglosa podras visualizar tu itinerario del viaje. Para cualquier duda no dudes en enviar un correo electrónico.

<x-mail::button :url="''">
Ver detalles
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>