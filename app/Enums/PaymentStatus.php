<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';

    public function getLabel(): string
    {
        return match($this) {
            self::PENDING => __('admin.pending'),
            self::PAID => __('admin.paid'),
            self::FAILED => __('admin.failed'),
            self::REFUNDED => __('admin.refunded'),
        };
    }

    public function getBadgeClass(): string
    {
        return match($this) {
            self::PENDING => 'badge-warning',
            self::PAID => 'badge-success',
            self::FAILED => 'badge-danger',
            self::REFUNDED => 'badge-info',
        };
    }

    public static function getOptions(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->getLabel()];
        })->toArray();
    }
}
