<?php

namespace App\Main\Model\Simcard\Query;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Main\Model\Simcard\Simcard;

class QueryBuilder extends Model
{
    public static function getall($request){

        $data = DB::table('simcards')

                ->join('sim_net_works', 'sim_net_works.id', '=', 'simcards.sim_network_id')
                ->select(
                    'simcards.*',
                    'sim_net_works.networkname as networkName'
                )
                ->where('sim_net_works.id', $request)
                ->get();

        return $data;
    }

    public static function getData($model, $requestcolumn, $requestData){

        $data = DB::table($model)
                ->where($requestcolumn, $requestData)
                ->first();

        return $data;
    }

    public static function submit_simcard($request, $network, $simName){

        $data = Simcard::create([
            'sim_network_id' => $network,
            'sim_name' => $simName,
            'sim_number' => $request['sim_number'],
            'sim_description' => $request['sim_description'],
            'sim_status' => $request['sim_status']
        ]);

        return $data;
    }

    public static function deleteData($model, $id){

        $data = DB::table($model)
                ->where('id', $id)
                ->delete();

        return $data;
    }

}
