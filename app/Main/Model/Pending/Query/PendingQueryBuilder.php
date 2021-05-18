<?php

namespace App\Main\Model\Pending\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\Pending\PendingTransaction;

class PendingQueryBuilder extends Model
{
    public static function create($status, $transactionId){

        $data = PendingTransaction::create([
            'transaction_details_id' => $transactionId,
            'status' => $status
        ]);

        return $data;
    }
}
