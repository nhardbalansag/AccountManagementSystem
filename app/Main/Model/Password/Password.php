<?php

namespace App\Main\Model\Password;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $fillable = [
        'emailid',
        'password',
        'status'
    ];
}
