<?php

namespace App\Main\Model\SubscriptionAccount\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\SubscriptionAccount\SubscriptionAccount;
use Illuminate\Support\Facades\DB;

class SubscriptionAccountQueryBuilder extends Model
{
    public static function createSubscriptionAccount($request){

        $data = SubscriptionAccount::create([
            'account_id' => $request['account_id'],
            'service_category_id' => $request['service_category_id'],
            'transaction_details_id' => $request['transaction_details_id'],
            'account_status' => $request['account_status']
        ]);

        return $data;

    }

    public static function getTableDataFirst($model, $filterId, $columnName){

        $data = DB::table($model)
                ->where($columnName, $filterId)
                ->first();

        return $data;
    }

    public static function getTableData($model, $filterId, $columnName){

        $data = DB::table($model)
                ->where($columnName, $filterId)
                ->get();

        return $data;
    }

    public static function getTableDataLimit($model, $filterId, $columnName, $limit){

        $data = DB::table($model)
                ->where($columnName, $filterId)
                ->limit($limit)
                ->get();

        return $data;
    }

    public static function checkClient($transaction_detailsId, $clientsId){

        $data = DB::table('subscription_accounts')
                ->join('transaction_details', 'transaction_details.id', '=', 'subscription_accounts.transaction_details_id')
                ->join('clients', 'clients.id', '=', 'transaction_details.client_id')
                ->select('clients.*')
                ->where('transaction_details.id', $transaction_detailsId)
                ->where('clients.id', $clientsId)
                ->first();

        return $data;
    }

    public static function getEmailAccounts($status, $detailId){

        $data = DB::table('subscription_accounts')
                ->join('accounts', 'accounts.id', '=', 'subscription_accounts.account_id')
                ->join('emails', 'emails.id', '=', 'accounts.emailid')
                ->join('passwords', 'passwords.emailid', '=', 'emails.id')
                ->join('simcards', 'simcards.id', '=', 'accounts.simcardid')
                ->join('sim_net_works', 'sim_net_works.id', '=', 'simcards.sim_network_id')
                ->select(
                    'subscription_accounts.id as subscription_accountsId',
                    'accounts.id as accountId',
                    'passwords.password as accountPassword',
                    'emails.emailaddress as accountEmailAddress',
                    'simcards.sim_number as simcardNumber',
                    'sim_net_works.networkname as network',
                    'subscription_accounts.account_status as account_status',
                )
                ->where('subscription_accounts.account_status', $status)
                ->where('subscription_accounts.transaction_details_id', $detailId)
                ->where('accounts.status', '!=', 'remove')
                ->where('passwords.status', '=', 'active')
                ->get();

        return $data;
    }

    public static function updateAccountStatus($model, $id, $column, $data){

        $data = DB::table($model)
                ->where('id', $id)
                ->update(
                    [
                        $column => $data
                    ]);

        return $data;
    }
}
