<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'messages';

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function from(): Attribute
    {
        return new Attribute(
            get: fn () => in_array($this->source_type, ['phone', 'sms'])
                ? $this->source->phone
                : $this->source->email,
        );
    }

    public function source()
    {
        return $this->morphTo();
    }
}
