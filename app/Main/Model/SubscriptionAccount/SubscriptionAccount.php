<?php

namespace App\Main\Model\SubscriptionAccount;

use Illuminate\Database\Eloquent\Model;

class SubscriptionAccount extends Model
{
    protected $fillable = [
        'account_id',
        'service_category_id',
        'transaction_details_id',
        'account_status'
    ];
}
