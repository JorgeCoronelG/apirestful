<?php

namespace App\Http\Util;

/**
 * Class Messages
 *
 * @author JorgeCoronelG
 * @package App\Http\Util
 * @version 1.0
 * Created 24/10/2020
 */
class Messages
{
    const MODEL_IS_DIRTY = 'Se debe especificar al menos un valor diferente para actualizar.';
    const AUTHENTICATION_EXCEPTION = 'No autenticado.';
    const MODEL_NOT_FOUND_EXCEPTION = 'No existe el recurso.';
    const AUTHORIZATION_EXCEPTION = 'No tiene permisos para ejecutar esta acción.';
    const NOT_FOUND_HTTP_EXCEPTION = 'No se encontró la URL especificada.';
    const METHOD_NOT_ALLOWED_HTTP_EXCEPTION = 'Método no válido.';
    const QUERY_EXCEPTION_1451 = 'No se puede eliminar el recurso porque está relacionado con algún otro.';
    const ERROR_SERVER = 'Ocurrió algo inesperado. Intente mas tarde.';
    const THROTTLE_REQUESTS_EXCEPTION = 'Muchos intentos realizados.';
}
