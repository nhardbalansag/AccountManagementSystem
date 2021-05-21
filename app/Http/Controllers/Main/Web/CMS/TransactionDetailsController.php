<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\TransactionDetail\Query\TransactionDetailQueryBuilder;
use Carbon\Carbon;


class TransactionDetailsController extends Controller
{
    public function transaction_invoice(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'transaction'){

            $transaction = $_GET['transaction'];

            $data['transaction'] = TransactionDetailQueryBuilder::getClientsTransactions($transaction);

            $data['businessEmail'] = TransactionDetailQueryBuilder::getTableDataFirst('emails', 'admin', 'emailrole');

            $today = Carbon::today('Asia/Manila');
            $arrtoday = explode(' ', $today);
            $date = $arrtoday[0];
            $data['dateNow'] = $date;

            return view('Content.Components.CMS.invoice', $data);

        }else{
            return redirect()->back();
        }

    }

    public function transaction_invoice_print(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'transaction'){

            $transaction = $_GET['transaction'];

            $data['transaction'] = TransactionDetailQueryBuilder::getClientsTransactions($transaction);

            $data['businessEmail'] = TransactionDetailQueryBuilder::getTableDataFirst('emails', 'admin', 'emailrole');

            $today = Carbon::today('Asia/Manila');
            $arrtoday = explode(' ', $today);
            $date = $arrtoday[0];
            $data['dateNow'] = $date;

            return view('Content.Components.CMS.invoice-print', $data);

        }else{
            return redirect()->back();
        }

    }
}
