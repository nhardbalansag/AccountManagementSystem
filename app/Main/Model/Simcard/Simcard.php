<?php

namespace App\Main\Model\Simcard;

use Illuminate\Database\Eloquent\Model;

class Simcard extends Model
{
    protected $fillable = [
        'sim_network_id',
        'sim_name',
        'sim_number',
        'sim_description',
        'sim_status'
    ];
}
