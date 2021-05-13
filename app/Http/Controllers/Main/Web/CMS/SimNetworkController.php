<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\SimNetwork\Query\QueryBuilder;

class SimNetworkController extends Controller
{
    public function index(){

        $data['simNetwork'] = QueryBuilder::getall();

        return view('Content.Components.CMS.network-list', $data);
    }
}
