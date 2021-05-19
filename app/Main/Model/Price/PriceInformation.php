<?php

namespace App\Main\Model\Price;

use Illuminate\Database\Eloquent\Model;

class PriceInformation extends Model
{
    protected $fillable = [
        'price',
        'price_status'
    ];
}
