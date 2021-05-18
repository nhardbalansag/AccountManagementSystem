<?php

namespace App\Main\Model\Client\Query;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Main\Model\Client\Client;

class ClientQueryBuilder extends Model
{
    public static function getTableData($model, $filterId = null, $columnName = null){

        $data = DB::table($model)
                ->where($columnName, $filterId)
                ->get();

        return $data;
    }

    public static function checkTableData($link, $service){

        $data = DB::table('clients')
                ->where('client_social_media_link', $link)
                ->where('service_category_id', $service)
                ->first();

        return $data;
    }

    public static function getTableDataFirst($model, $filterId, $columnName){

        $data = DB::table($model)
                ->where($columnName, $filterId)
                ->first();

        return $data;
    }

    public static function createClient($request){

        $data = Client::create([
            'client_email' => $request['client_email'],
            'client_phone_number' => $request['client_phone_number'],
            'client_name' => $request['client_name'],
            'client_social_media_account_name' => $request['client_social_media_account_name'],
            'client_social_media_link' => $request['client_social_media_link'],
            'service_category_id' => $request['service_category_id']
        ]);

        return $data;

    }

    public static function getClientsTransactions($status){

        $data = DB::table('subscription_accounts')
                ->join('transaction_details', 'transaction_details.id', '=', 'subscription_accounts.transaction_details_id')
                ->join('clients', 'clients.id', '=', 'transaction_details.client_id')
                ->join('service_categories', 'service_categories.id', '=', 'clients.service_category_id')
                ->select(
                    'transaction_details.id as transactionId',
                    'transaction_details.transaction_details_number as transaction_details_number',
                    'clients.client_social_media_account_name as client_social_media_account_name',
                    'clients.client_email as client_email',
                    'transaction_details.client_boost_number_target as client_boost_number_target',
                )
                ->where('subscription_accounts.account_status', $status)
                ->groupBy('transactionId')
                ->get();

        return $data;
    }

    public static function getClientsLackingTransactions($status){

        $data = DB::table('subscription_accounts')
                ->join('transaction_details', 'transaction_details.id', '=', 'subscription_accounts.transaction_details_id')
                ->join('clients', 'clients.id', '=', 'transaction_details.client_id')
                ->join('service_categories', 'service_categories.id', '=', 'clients.service_category_id')
                ->join('pending_transactions', 'pending_transactions.transaction_details_id', '=', 'transaction_details.id')
                ->select(
                    'transaction_details.id as transactionId',
                    'transaction_details.transaction_details_number as transaction_details_number',
                    'clients.client_social_media_account_name as client_social_media_account_name',
                    'clients.client_email as client_email',
                    'transaction_details.client_boost_number_target as client_boost_number_target',
                )
                ->where('pending_transactions.status', $status)
                ->groupBy('transactionId')
                ->get();

        return $data;
    }

    public static function getPendingData($transacId, $status){

        $data = DB::table('subscription_accounts')
                ->join('transaction_details', 'transaction_details.id', '=', 'subscription_accounts.transaction_details_id')
                ->join('clients', 'clients.id', '=', 'transaction_details.client_id')
                ->join('service_categories', 'service_categories.id', '=', 'clients.service_category_id')
                ->select(
                    'transaction_details.id as transactionId',
                    'clients.client_email as client_email',
                    'transaction_details.client_boost_number_target as client_boost_number_target',
                )
                ->where('subscription_accounts.account_status', $status)
                ->where('subscription_accounts.transaction_details_id', ($transacId))
                ->get();

        return $data;
    }

    public static function getPendingTotalAccountGive($transacId){

        $data = DB::table('subscription_accounts')
                ->join('transaction_details', 'transaction_details.id', '=', 'subscription_accounts.transaction_details_id')
                ->join('clients', 'clients.id', '=', 'transaction_details.client_id')
                ->join('service_categories', 'service_categories.id', '=', 'clients.service_category_id')
                ->select(
                    'transaction_details.id as transactionId',
                    'clients.client_email as client_email',
                    'transaction_details.client_boost_number_target as client_boost_number_target',
                )
                ->where('subscription_accounts.transaction_details_id', ($transacId))
                ->get();

        return $data;
    }
}
