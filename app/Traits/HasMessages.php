<?php

namespace App\Traits;

use App\Models\Message;

trait HasMessages
{
    public function messages()
    {
        return $this->morphMany(Message::class, 'source');
    }

    public static function booted()
    {
        static::deleting(function (self $model) {
            $model->messages()->delete();
        });
    }
}
