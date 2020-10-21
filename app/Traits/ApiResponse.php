<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponse
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['code' => $code, 'error' => $message], $code);
    }

    protected function noContentResponse()
    {
        return response()->noContent();
    }

    protected function showAll(ResourceCollection $collection, $code = 200)
    {
        return $this->successResponse($collection, $code);
    }

    protected function showOne(JsonResource $resource, $code = 200)
    {
        return $this->successResponse(['data' => $resource], $code);
    }
}
