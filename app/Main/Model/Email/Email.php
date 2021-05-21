<?php

namespace App\Main\Model\Email;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'emailaddress',
        'emailbirthday',
        'emaildescription',
        'emailstatus',
        'emailrole',
    ];
}
