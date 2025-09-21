<?php

namespace App\Enums;

enum OrderType: int
{
    case by_user     = 1;
    case by_provider = 2;

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
