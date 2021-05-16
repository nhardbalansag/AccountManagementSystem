<?php

namespace App\Main\Model\SubscriptionAccount\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\SubscriptionAccount\SubscriptionAccount;

class SubscriptionAccountQueryBuilder extends Model
{
    public static function createSubscriptionAccountb($request){

        $data = SubscriptionAccount::create([
            'account_id' => $request['account_id'],
            'service_category_id' => $request['service_category_id'],
            'transaction_details_id' => $request['transaction_details_id'],
            'account_status' => $request['account_status']
        ]);

        return $data;

    }
}
