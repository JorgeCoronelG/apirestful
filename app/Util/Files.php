<?php

namespace App\Util;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

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
     * Método para subir una imagen al servidor
     *
     * @param UploadedFile $imageFile
     * @param string $customPath
     * @return string
     */
    public static function uploadImage(UploadedFile $imageFile, string $customPath): string
    {
        try {
            $imageName = Str::random(Constants::IMAGE_NAME_LENGHT).
                self::getFileExtension($imageFile->getClientOriginalName());
            $pathUrl = self::getFilePublicPath($imageName, $customPath);
            Image::make($imageFile)
                ->resize(null, Constants::IMAGE_HEIGHT, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($pathUrl);
            return $imageName;
        } catch (\Exception $e) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * Método para eliminar un archivo del servidor
     *
     * @param string $filename
     * @param string $customPath
     */
    public static function deleteFile(string $filename, string $customPath): void
    {
        Storage::delete(Files::getFileStoragePath($filename, $customPath));
    }

    /**
     * Obtener la extensión de un archivo
     *
     * @param string $file
     * @return string .png .jpg .pdf .xls
     */
    public static function getFileExtension(string $file): string
    {
        return '.'.pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * Obtener el filepath público de un archivo
     *
     * @param string $filename
     * @param string $customPath
     * @return string
     */
    public static function getFilePublicPath(string $filename, string $customPath): string
    {
        return public_path(Constants::PATH_STORAGE.$customPath.$filename);
    }

    /**
     * Obtener el filepath storage de un archivo
     *
     * @param string $filename
     * @param string $customPath
     * @return string
     */
    public static function getFileStoragePath(string $filename, string $customPath): string
    {
        return Constants::PATH_STORAGE_PUBLIC.$customPath.$filename;
    }
}
