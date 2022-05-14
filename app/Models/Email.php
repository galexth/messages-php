<?php

namespace App\Models;

use App\Traits\HasMessages;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasMessages;

    protected $table = 'emails';

    protected $fillable = ['email'];

    /**
     * @var array
     */
    protected $casts = [
        'settings' => AsArrayObject::class,
    ];
}
