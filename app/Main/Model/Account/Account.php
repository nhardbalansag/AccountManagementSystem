<?php

namespace App\Main\Model\Account;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'emailid',
        'simcardid',
        'status'
    ];
}
