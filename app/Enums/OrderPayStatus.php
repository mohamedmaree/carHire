<?php

namespace App\Enums;

enum OrderPayStatus: int
{
    case pending     = 1;
    case down_payment = 2;
    case done        = 3;
    case returned    = 4;

    public static function toArray(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public static function nameFor(int $value): ?string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->name;
            }
        }

        return null;
    }
}
