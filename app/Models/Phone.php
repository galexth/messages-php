<?php

namespace App\Models;

use App\Traits\HasMessages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory, SoftDeletes, HasMessages;

    protected $table = 'phones';

    protected $fillable = ['phone'];
}
