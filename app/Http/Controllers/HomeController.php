<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Main\Model\Client\Query\ClientQueryBuilder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $data['lacking'] = ClientQueryBuilder::getTableData('pending_transactions', 'pending', 'status');
        // $data['subscription'] = ClientQueryBuilder::getTableData('subscription_accounts', 'pending', 'account_status');

        return view('Content.Components.CMS.dashboard');
    }
}
