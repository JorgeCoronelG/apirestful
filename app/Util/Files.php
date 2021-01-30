<?php

namespace App\Util;

/**
 * Class Files
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Util
 * Created 23/01/2021
 */
class Files
{
    /**
     * Obtener la extensión de una imagen
     *
     * @param string $image
     * @return string .png .jpg
     */
    public static function getImageExtension(string $image): string
    {
        return '.'.pathinfo($image, PATHINFO_EXTENSION);
    }

    /**
     * Obtener el filepath público de la imagen del usuario
     *
     * @param string $photo
     * @return string
     */
    public static function getUserImagePublicPath(string $photo): string
    {
        return public_path(Constants::PATH_STORAGE.Constants::PATH_USER_IMAGES.$photo);
    }

    /**
     * Obtener el filepath storage de la imagen del usuario
     *
     * @param string $photo
     * @return string
     */
    public static function getUserImageStoragePath(string $photo): string
    {
        return Constants::PATH_STORAGE_PUBLIC.Constants::PATH_USER_IMAGES.$photo;
    }
}
