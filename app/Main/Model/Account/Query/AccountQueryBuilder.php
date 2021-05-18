<?php

namespace App\Main\Model\Account\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\Account\Account;
use Illuminate\Support\Facades\DB;

class AccountQueryBuilder extends Model
{
    public static function createAccount($request, $emailId, $simcardId){

        $data = Account::create([
            'emailid' => $emailId,
            'simcardid' => $simcardId,
            'status' => $request['status']
        ]);

        return $data;
    }

    public static function SimAccounts($simcardId){
        $data = DB::table('accounts')
                ->join('simcards', 'simcards.id', '=', 'accounts.simcardid')
                ->join('emails', 'emails.id', '=', 'accounts.emailid')
                ->join('passwords', 'passwords.emailid', '=', 'emails.id')
                ->select('passwords.password as accountPassword', 'emails.emailaddress as accountEmailAddress')
                ->where('accounts.simcardid', $simcardId)
                ->where('accounts.status', '!=', 'remove')
                ->where('passwords.status', '=', 'active')
                ->get();

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

    public static function getAllAccountUsed($clientId, $serviceId){

        $data = DB::table('accounts')
                ->join('subscription_accounts', 'subscription_accounts.account_id', '=', 'accounts.id')
                ->join('emails', 'emails.id', '=', 'accounts.emailid')
                ->join('transaction_details', 'transaction_details.id', '=', 'subscription_accounts.transaction_details_id')
                ->join('clients', 'clients.id', '=', 'transaction_details.client_id')
                ->join('service_categories', 'service_categories.id', '=', 'subscription_accounts.service_category_id')
                ->select(
                    'accounts.id as emailaddress_Id'
                )
                ->where('clients.id', $clientId)
                ->where('service_categories.id', $serviceId)
                ->get();

        return $data;

    }

}
