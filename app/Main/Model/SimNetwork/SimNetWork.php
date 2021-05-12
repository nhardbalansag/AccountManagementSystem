<?php

namespace App\Main\Model\SimNetwork;

use Illuminate\Database\Eloquent\Model;

class SimNetWork extends Model
{
    protected $fillable = [
        'networkname',
        'networkdescription',
        'networkstatus'
    ];
}
