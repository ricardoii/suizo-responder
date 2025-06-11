<?php

namespace Ricardo\ApiSuizoService;

use Illuminate\Foundation\Configuration\Exceptions;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Auth\AuthenticationException;

use Throwable;

class ExceptionApiRegistrar
{
    public static function bind(Exceptions $exceptions): void
    {
        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof AccessDeniedHttpException) {
                    return apisuizo()->unauthorized('No tiene permiso para ejecutar esta API');
                }

                if ($e instanceof NotFoundHttpException) {
                    return apisuizo()->notFound('URL no encontrada');
                }

                if ($e instanceof TooManyRequestsHttpException) {
                    return apisuizo()->errorResponse(429, 'Demasiadas peticiones');
                }

                if ($e instanceof RouteNotFoundException) {
                    return apisuizo()->unauthorized('Token inválido o no enviado');
                }
                if ($e instanceof AuthenticationException) {
                    return apisuizo()->unauthorized('Token de autorización requerido o inválido');
                }
            }

            return null;
        });
    }
}
