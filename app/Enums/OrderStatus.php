<?php

namespace App\Enums;

enum OrderStatus: int
{
    case new = 1;
    case accepted = 2;
    case refused = 3;
    case cancel = 4;
    case finished = 5;

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
