@component('mail::message')
    Hola {{$name}}

    Hemos creado con éxito tu cuenta. Por favor, verifícala usando el siguiente código:<br>
    <strong>{{ $verification_token }}</strong>

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
