<?php

namespace App\Main\Model\Pending\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\Pending\PendingTransaction;
use Illuminate\Support\Facades\DB;

class PendingQueryBuilder extends Model
{
    public static function create($status, $transactionId){

        $data = PendingTransaction::create([
            'transaction_details_id' => $transactionId,
            'status' => $status
        ]);

        return $data;
    }

    public static function updateColumn($model, $dataFilter, $column, $data, $updateColumn){

        $data = DB::table($model)
                ->where($column, $dataFilter)
                ->update(
                    [
                        $updateColumn => $data
                    ]);

        return $data;
    }
}
