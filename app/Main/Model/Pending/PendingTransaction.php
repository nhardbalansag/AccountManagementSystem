<?php

namespace App\Main\Model\Pending;

use Illuminate\Database\Eloquent\Model;

class PendingTransaction extends Model
{
    protected $fillable = [
        'status',
        'transaction_details_id'
    ];
}
