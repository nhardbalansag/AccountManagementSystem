<?php

namespace App\Main\Model\TransactionDetail\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\TransactionDetail\TransactionDetail;

class TransactionDetailQueryBuilder extends Model
{
    public static function createTransactionDetail($request, $clientId, $transactionNumber){

        $data = TransactionDetail::create([
            'transaction_details_number' => $transactionNumber,
            'payment_status' => $request['payment_status'],
            'payment_type' => $request['payment_type'],
            'client_id' => $clientId
        ]);

        return $data;

    }
}
