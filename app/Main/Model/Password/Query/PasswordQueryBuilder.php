<?php

namespace App\Main\Model\Password\Query;

use Illuminate\Database\Eloquent\Model;
use App\Main\Model\Password\Password;
use Illuminate\Support\Facades\DB;

class PasswordQueryBuilder extends Model
{
    public static function createEmailPassword($request, $emailId){

        $data = Password::create([
            'password' => $request['password'],
            'status' => "active",
            'emailid' => $emailId
        ]);

        return $data;
    }

    public static function updateColumn($model, $dataFilter, $id, $column, $data){

        $data = DB::table($model)
                ->where($column, $dataFilter)
                ->where('emailid', $id)
                ->update(
                    [
                        $column => $data
                    ]);

        return $data;
    }
}
