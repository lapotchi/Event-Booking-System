<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case ORGANIZER = 'organizer';
    case CUSTOMER = 'customer';

    public static function except(self ...$excluded): array
    {
        return array_values(
            array_map(
                fn($case) => $case->value,
                array_filter(
                    self::cases(),
                    fn($case) => !in_array($case, $excluded, true)
                )
            )
        );
    }

    public static function publicRoles(): array
    {
        return self::except(self::ADMIN);
    }
}