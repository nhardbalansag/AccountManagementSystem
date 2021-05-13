<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\SocialMedialPlatform\Query\QueryBuilder;

class SocialMediaPlatformController extends Controller
{
    public function index(){

        $data['platform'] = QueryBuilder::getall();

        return view('Content.Components.CMS.platforms', $data);
    }
}
