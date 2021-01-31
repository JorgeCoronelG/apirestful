@component('mail::message')
    Hola {{$name}}

    Has cambiado tu correo electrónico. Por favor, verifícala usando el siguiente código:<br>
    <strong>{{ $verification_token }}</strong>

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
