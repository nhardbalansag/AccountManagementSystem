<?php

namespace App\Main\Model\Price\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\Price\PriceInformation;
use Illuminate\Support\Facades\DB;

class PriceInformationQueryBuilder extends Model
{
    public static function create($request){

        $data = PriceInformation::create([
            'price' => $request['price'],
            'price_status' => $request['price_status']
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
}
