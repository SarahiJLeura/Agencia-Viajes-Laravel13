<x-mail::message>
# ¡Bienvenido {{ $user->name }}! 🎉

Gracias por registrarte en **GlobalQuest**.

Ya puedes comenzar a planear tus viajes y explorar nuevos destinos.

<x-mail::button :url="url('/dashboard')">
Ir al panel
</x-mail::button>

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>