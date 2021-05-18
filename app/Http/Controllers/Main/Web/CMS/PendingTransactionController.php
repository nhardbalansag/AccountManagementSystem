<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\Pending\Query\PendingQueryBuilder;

class PendingTransactionController extends Controller
{
    public function createPendingTransaction($id){

        $transactionId = $id;
        $status = 'pending';

        if($data = PendingQueryBuilder::create($status, $transactionId)){

            return redirect()->back()->with('success', 'data created');
        }
    }
}
