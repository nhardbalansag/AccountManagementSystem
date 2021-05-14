<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\SimNetwork\Query\QueryBuilder;

class SimNetworkController extends Controller
{
    public function index(){

        $data['simNetwork'] = QueryBuilder::getall();

        $network = array();

        foreach ($data['simNetwork'] as $key => $value) {
            $networkId = $value->id;

            $sim = QueryBuilder::getCount($networkId);

            array_push(
                $network,
                array(
                    'netWorkName' => $value->networkname,
                    'status' => $value->networkstatus,
                    'id' => $value->id,
                    'numberRegisteredCount' => $sim->count(),
                )
            );
        }

        $data['data'] = $network;

        return view('Content.Components.CMS.network-list', $data);
    }
}
