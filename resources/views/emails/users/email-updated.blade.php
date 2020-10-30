@component('mail::message')
    Hola {{$name}}

    Has cambiado tu correo electrónico. Por favor, verifícala usando el siguiente botón:

    @component('mail::button', ['url' => route('verify', $verification_token)])
        Verificar correo
    @endcomponent

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
