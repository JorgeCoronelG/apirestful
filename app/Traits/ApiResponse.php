<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponse
{
    /**
     * Función que retorna una respuesta JSON exitosa
     *
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    /**
     * Función que retorna una respuesta JSON erronea
     *
     * @param $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code)
    {
        return response()->json(['code' => $code, 'error' => $message], $code);
    }

    /**
     * Función que retorna una respuesta 204 no content
     *
     * @return \Illuminate\Http\Response
     */
    protected function noContentResponse()
    {
        return response()->noContent();
    }

    /**
     * Función que retorna un JSON con un listado de registros
     *
     * @param ResourceCollection $collection
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showAll(ResourceCollection $collection, $code = 200)
    {
        return $this->successResponse($collection, $code);
    }

    /**
     * Función que retorna un JSON con un registro
     *
     * @param JsonResource $resource
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showOne(JsonResource $resource, $code = 200)
    {
        return $this->successResponse(['data' => $resource], $code);
    }

    /**
     * Función que retorna un JSON con un mensaje
     *
     * @param String $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showMessage(String $message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }
}
