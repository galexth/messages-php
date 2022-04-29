<?php

namespace App\Enums;

class EmailStatus extends Status
{
    public const SENT = 'sent';
    public const ERROR = 'error';

    public static function all(): array
    {
        return [
            static::SENT,
            static::ERROR
        ];
    }
}
