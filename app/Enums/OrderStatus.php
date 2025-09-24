<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function getLabel(): string
    {
        return match($this) {
            self::PENDING => __('admin.pending'),
            self::CONFIRMED => __('admin.confirmed'),
            self::IN_PROGRESS => __('admin.in_progress'),
            self::COMPLETED => __('admin.completed'),
            self::CANCELLED => __('admin.cancelled'),
        };
    }

    public function getBadgeClass(): string
    {
        return match($this) {
            self::PENDING => 'badge-warning',
            self::CONFIRMED => 'badge-info',
            self::IN_PROGRESS => 'badge-primary',
            self::COMPLETED => 'badge-success',
            self::CANCELLED => 'badge-danger',
        };
    }

    public static function getOptions(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->getLabel()];
        })->toArray();
    }
}