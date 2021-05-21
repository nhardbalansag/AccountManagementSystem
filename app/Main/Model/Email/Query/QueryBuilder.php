<?php

namespace App\Main\Model\Email\Query;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Main\Model\Email\Email;

class QueryBuilder extends Model
{
    public static function registerEmail($request){

        $data = Email::create([
            'firstname' => $request['firstname'],
            'middlename' => $request['middlename'],
            'lastname' => $request['lastname'],
            'emailaddress' => $request['emailaddress'],
            'emailbirthday' => $request['emailbirthday'],
            'emaildescription' => $request['emaildescription'],
            'emailstatus' => $request['status'],
            'emailrole' => $request['emailrole'],
        ]);

        return $data;
    }

    public static function getEmailAccounts(){
        $data = DB::table('accounts')
                ->join('simcards', 'simcards.id', '=', 'accounts.simcardid')
                ->join('sim_net_works', 'sim_net_works.id', '=', 'simcards.sim_network_id')
                ->join('emails', 'emails.id', '=', 'accounts.emailid')
                ->join('passwords', 'passwords.emailid', '=', 'emails.id')
                ->select(
                    'accounts.id as accountId',
                    'passwords.password as accountPassword',
                    'emails.emailaddress as accountEmailAddress',
                    'simcards.sim_number as simcardNumber',
                    'sim_net_works.networkname as network',
                )
                ->where('accounts.status', '!=', 'remove')
                ->where('passwords.status', '=', 'active')
                ->groupBy(
                    'accountId',
                    'accountPassword',
                    'accountEmailAddress',
                    'simcardNumber',
                    'network'
                )
                ->get();

        return $data;
    }

    public static function getEmailRegisteredInNumber($sim){
        $data = DB::table('accounts')
                ->join('simcards', 'simcards.id', '=', 'accounts.simcardid')
                ->join('sim_net_works', 'sim_net_works.id', '=', 'simcards.sim_network_id')
                ->join('emails', 'emails.id', '=', 'accounts.emailid')
                ->join('passwords', 'passwords.emailid', '=', 'emails.id')
                ->select(
                    'accounts.id as accountId',
                    'passwords.password as accountPassword',
                    'emails.emailaddress as accountEmailAddress',
                    'simcards.sim_number as simcardNumber',
                    'sim_net_works.networkname as network',
                )
                ->where('accounts.status', '!=', 'remove')
                ->where('passwords.status', '=', 'active')
                ->where('simcards.id', $sim)
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

}
