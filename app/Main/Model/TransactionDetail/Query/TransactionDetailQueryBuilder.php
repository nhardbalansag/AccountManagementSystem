<?php

namespace App\Main\Model\TransactionDetail\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\TransactionDetail\TransactionDetail;
use Illuminate\Support\Facades\DB;

class TransactionDetailQueryBuilder extends Model
{
    public static function createTransactionDetail($request, $clientId, $transactionNumber){

        $data = TransactionDetail::create([
            'transaction_details_number' => $transactionNumber,
            'payment_status' => $request['payment_status'],
            'payment_type' => $request['payment_type'],
            'client_boost_number_target' => $request['client_boost_number_target'],
            'client_id' => $clientId,
        ]);

        return $data;

    }

    public static function getClientsTransactions($transaction){

        $data = DB::table('subscription_accounts')
                ->join('transaction_details', 'transaction_details.id', '=', 'subscription_accounts.transaction_details_id')
                ->join('clients', 'clients.id', '=', 'transaction_details.client_id')
                ->join('service_categories', 'service_categories.id', '=', 'clients.service_category_id')
                ->select(

                    'transaction_details.id as transactionId',
                    'transaction_details.transaction_details_number as transaction_details_number',
                    'transaction_details.client_boost_number_target as client_boost_number_target',
                    'transaction_details.created_at as transaction_created_at',
                    'transaction_details.payment_type as payment_type',
                    'transaction_details.payment_status as payment_status',

                    'clients.client_phone_number as client_phone_number',
                    'clients.client_email as client_email',
                    'clients.client_name as client_name',
                    'clients.client_social_media_account_name as client_social_media_account_name',

                    'service_categories.service_category_name as service_category_name',

                )
                ->where('transaction_details.id', $transaction)
                ->groupBy('transactionId')
                ->first();

        return $data;
    }
}
