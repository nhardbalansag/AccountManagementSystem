<?php

namespace App\Main\Model\TransactionDetail;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'client_id',
        'transaction_details_number',
        'payment_status',
        'payment_type'
    ];
}
