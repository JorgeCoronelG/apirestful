@component('mail::message')
    Hola {{$name}}

    Hemos creado tu cuenta. Por favor, verifícala usando el siguiente enlace:
    @component('mail::button', ['url' => route('verify', $verification_token)])
        Verificar cuenta
    @endcomponent

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
