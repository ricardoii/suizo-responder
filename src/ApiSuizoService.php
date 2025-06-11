<?php

namespace Ricardo\ApiSuizoService;

use Illuminate\Http\JsonResponse;

class ApiSuizoService
{

    //use Macroable;
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_FORBIDDEN = 403;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    public function successResponse(int $status = 200, ?string $message = null, mixed $data = null): JsonResponse
    {
        $json = [
            'status'  => $status,
            'message' => $message
        ];
        if ($data !== null) {
            $json['data'] = $data;
        }
        return response()->json($json, $status);
    }

    public function errorResponse(int $status = 500, ?string $message = null, mixed $errors = null): JsonResponse
    {
        if (is_object($errors)) {
            $errors = [$errors];
        }
        if (is_array($errors) && $this->isAssociativeArray($errors)) {
            $errors = [$errors];
        }
        $json = [
            'status'  => $status,
            'message' => $message,
        ];

        if ($errors !== null) {
            $json['errors'] = $errors;
        }
        return response()->json($json, $status);
    }

    public function success(?string $message = null, mixed $data = null): JsonResponse
    {
        return $this->successResponse(static::HTTP_OK, $message, $data);
    }

    public function error(?string $message = null, mixed $errors = null): JsonResponse
    {
        return $this->errorResponse(static::HTTP_INTERNAL_SERVER_ERROR, $message, $errors);
    }

    public function notFound(?string $message = null, mixed $errors = null): JsonResponse
    {
        return $this->errorResponse(static::HTTP_NOT_FOUND, $message, $errors);
    }

    public function validation($message = null, mixed $errors = null): JsonResponse
    {
        return $this->errorResponse(static::HTTP_UNPROCESSABLE_ENTITY, $message, $errors);
    }

    public function forbidden($message = null, mixed $errors = null): JsonResponse
    {
        return $this->errorResponse(static::HTTP_FORBIDDEN, $message, $errors);
    }

    public function unauthorized($message = null, mixed $errors = null): JsonResponse
    {
        return $this->errorResponse(static::HTTP_UNAUTHORIZED, $message, $errors);
    }

    public function serverError($message = null, mixed $errors = null): JsonResponse
    {
        return $this->errorResponse(static::HTTP_INTERNAL_SERVER_ERROR, $message, $errors);
    }
    // Método auxiliar para determinar si un array es asociativo
    private function isAssociativeArray(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }
}
