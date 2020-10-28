<?php

namespace App\Util;

/**
 * Class Messages
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Util
 * Created 24/10/2020
 */
class Messages
{
    // Mensajes generales
    const MODEL_IS_DIRTY = 'Se debe especificar al menos un valor diferente para actualizar.';
    const CREDENTIALS_INVALID = 'Credenciales inválidas.';
    const USER_IS_VERIFIED = 'El usuario ya fue verificado.';
    const USER_NOT_VERIFIED = 'Usuario no verificado.';

    // Mensajes de excepciones
    const AUTHENTICATION_EXCEPTION = 'No autenticado.';
    const MODEL_NOT_FOUND_EXCEPTION = 'No existe el registro.';
    const AUTHORIZATION_EXCEPTION = 'No tiene permisos para ejecutar esta acción.';
    const NOT_FOUND_HTTP_EXCEPTION = 'No se encontró la URL especificada.';
    const METHOD_NOT_ALLOWED_HTTP_EXCEPTION = 'Método no válido.';
    const QUERY_EXCEPTION_1451 = 'No se puede eliminar el recurso porque está relacionado con algún otro.';
    const INTERNAL_SERVER_ERROR = 'Ocurrió algo inesperado. Intente mas tarde.';
    const THROTTLE_REQUESTS_EXCEPTION = 'Muchos intentos realizados.';

    // Mensajes de asunto de correo electrónico
    const CONFIRM_EMAIL = 'Confirma tu correo electrónico';
    const EMAIL_UPDATED = 'Confirma tu nuevo correo electrónico';
}
