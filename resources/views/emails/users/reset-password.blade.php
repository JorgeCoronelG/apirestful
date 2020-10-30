@component('mail::message')
    Hola {{$name}}

    Se ha restablecido tu contraseña de manera exitosa.

    Tu nueva contraseña es: <b>{{$new_password}}</b>

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
