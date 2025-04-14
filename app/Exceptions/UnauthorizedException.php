<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
    private $requiredRoles = [];

    private $requiredPermissions = [];

    public static function forRoles(array $roles): self
    {
        $message = 'No tienes el permiso necesario para acceder a esta página';

        if (config('permission.display_role_in_exception')) {
            $message .= ' Los roles requeridos son: ' . implode(', ', $roles);
        }

        $exception = new static(403, $message, null, []);
        $exception->requiredRoles = $roles;

        return $exception;
    }

    public static function forPermissions(array $permissions): self
    {
        $message = 'No tienes el permiso necesario para acceder a esta página.';

        if (config('permission.display_permission_in_exception')) {
            $message .= ' Los permisos requeridos son: ' . implode(', ', $permissions);
        }

        $exception = new static(403, $message, null, []);
        $exception->requiredPermissions = $permissions;

        return $exception;
    }
}
