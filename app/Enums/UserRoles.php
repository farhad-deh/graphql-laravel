<?php

namespace App\Enums;

enum UserRoles: string
{
    case Admin = 'admin';
    case User = 'user';
    case Viewer = 'viewer';

    public function description(): string
    {
        return match ($this) {
            self::Admin => 'Admin has all access in system',
            self::User => 'Users can give scores too foods',
            self::Viewer => 'Viewers are just viewers ! '
        };
    }
}
