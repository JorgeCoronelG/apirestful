<?php

namespace App\Util;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Validations
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Util
 * Created 23/01/2021
 */
class Validations
{
    /**
     * Función para validar una fecha en formato AAAA/MM/DD
     *
     * @param string|null $date
     * @return string|null
     */
    public static function validateDate(string $date = null)
    {
        if (is_null($date)) {
            return null;
        }
        $dateParse = null;
        if (Str::of($date)->contains('/')) {
            $dateParse = explode('/', $date);
        }
        if (Str::of($date)->contains('-')) {
            $dateParse = explode('-', $date);
        }
        if (is_null($dateParse)) {
            abort(Response::HTTP_BAD_REQUEST, Messages::INVALID_QUERY_PARAMETER);
        }
        if(count($dateParse) === 3 && checkdate($dateParse[1], $dateParse[2], $dateParse[0])){
            return $date;
        }
        abort(Response::HTTP_BAD_REQUEST, Messages::INVALID_QUERY_PARAMETER);
    }

    /**
     * Función para validar un número telefónico
     *
     * @param string|null $phone
     * @return false|string
     */
    public static function validatePhoneNumber(string $phone = null)
    {
        if (is_null($phone)) {
            return null;
        }
        if (!ctype_digit($phone)) {
            abort(Response::HTTP_BAD_REQUEST, Messages::INVALID_QUERY_PARAMETER);
        }
        $phoneParse = '';
        switch (strlen($phone)) {
            case 1:
            case 2:
            case 3:
                $phoneParse = substr($phone, 0);
                break;
            case 4:
            case 5:
            case 6:
                $phoneParse = substr($phone,0, 3);
                $phoneParse .= '-';
                $phoneParse .= substr($phone,3, strlen($phone) - 3);
                break;
            case 7:
            case 8:
            case 9:
            case 10:
                $phoneParse = substr($phone, 0,3);
                $phoneParse .= '-';
                $phoneParse .= substr($phone,3, 3);
                $phoneParse .= '-';
                $phoneParse .= substr($phone,6, strlen($phone) - 6);
                break;
            default:
                abort(Response::HTTP_BAD_REQUEST, Messages::INVALID_QUERY_PARAMETER);
        }
        return $phoneParse;
    }
}
