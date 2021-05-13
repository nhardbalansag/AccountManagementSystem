<?php

namespace App\Main\Model\SimNetwork\Query;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Main\Model\SimNetwork\SimNetWork;

class QueryBuilder extends Model
{
    public static function getall(){
        $data = DB::table('sim_net_works')->get();

        return $data;
    }
}
