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
                ->get();

        return $data;
    }

}
