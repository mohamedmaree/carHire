<?php

namespace App\Enums;

enum OrderPayType: int
{
    case undefined = 1;
    case cash      = 2;
    case wallet    = 3;
    case bank      = 4;
    case online    = 5;

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
