<?php

namespace App\Enums;

class PhoneStatus extends Status
{
    public const NO_RESPONSE = 'no_response';
    public const ANSWERED = 'answered';
    public const BUSY = 'busy';

    public static function all(): array
    {
        return [
            static::NO_RESPONSE,
            static::ANSWERED,
            static::BUSY,
        ];
    }
}
