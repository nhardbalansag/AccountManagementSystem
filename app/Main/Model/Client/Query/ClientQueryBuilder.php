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

    public static function createClient($request){

        $data = Client::create([
            'client_email' => $request['client_email'],
            'client_phone_number' => $request['client_phone_number'],
            'client_name' => $request['client_name'],
            'client_social_media_account_name' => $request['client_social_media_account_name'],
            'client_social_media_link' => $request['client_social_media_link'],
            'client_boost_number_target' => $request['client_boost_number_target'],
            'service_category_id' => $request['service_category_id']
        ]);

        return $data;

    }
}
