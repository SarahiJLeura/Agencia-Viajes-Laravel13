<x-mail::message>
# Introduction

Gracias {{ $user }} por hacer la reservacion con nosotros.
A continuacion se desgloza más informacion:


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
