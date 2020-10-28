Hola {{$name}}
Has cambiado tu correo electrónico. Por favor, verifícala usando el siguiente enlace:

{{route('verify', $verification_token)}}
