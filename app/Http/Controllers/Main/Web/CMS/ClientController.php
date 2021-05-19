<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\Client\Query\ClientQueryBuilder;
use Illuminate\Support\Facades\Validator;
use App\Main\Model\SubscriptionAccount\Query\SubscriptionAccountQueryBuilder;
use App\Main\Model\TransactionDetail\Query\TransactionDetailQueryBuilder;
use App\Http\Controllers\Main\Web\CMS\PendingTransactionController;
use App\Main\Model\Pending\Query\PendingQueryBuilder;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function create_new_client(){

        $data['serviceCategory'] = ClientQueryBuilder::getTableData('service_categories', 'active', 'service_category_status');

        $model = 'price_information';
        $filterId = 'active';
        $columnName = 'price_status';

        $data['priceInfo'] = TransactionDetailQueryBuilder::getTableData($model, $filterId, $columnName);

        return view('Content.Components.CMS.add-new-client', $data);
    }

    public function submit_new_client(Request $request){

        $rules = [
            'service_category_id' => ['required', 'numeric'],
            'client_boost_number_target' => ['required', 'numeric', 'min:1'],
            'client_email' => ['required', 'string', 'email', 'max:255'],
            'client_phone_number' => ['string', 'max:255'],
            'client_name' => ['required', 'string', 'max:255'],
            'client_social_media_account_name' => ['required', 'string', 'max:255'],
            'client_social_media_link' => ['required', 'string', 'max:255'],
            'payment_status' => ['required', 'string'],
            'payment_type' => ['required', 'string']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->back()->with('error', 'Error adding data');

        }else{

            unset($request['_token']);

            //check if client url is exist
            $dataContent = $request['client_social_media_link'];
            $serviceCategory = $request['service_category_id'];

            $clientInfo = ClientQueryBuilder::checkTableData($dataContent, $serviceCategory);
            $accounts = ClientQueryBuilder::getTableData('accounts', 'active', 'status');

            $data = ClientQueryBuilder::getTableData('transaction_details', null, null);

            $transactionCount = $data->count() + 1;
            $today = Carbon::today();
            $arrtoday = explode(' ', $today);
            $date = explode('-', $arrtoday[0]);
            $year = $date[0];

            $transaction_details_number = $year . "-BPH-" . $transactionCount;

            //get the data of price id
            $model = 'price_information';
            $filterId = $request['price_information_id'];
            $columnName = 'id';

            $priceInfo = TransactionDetailQueryBuilder::getTableDataFirst($model, $filterId, $columnName);
            $price_amount = $priceInfo->price;
            $targetAccount = $request['client_boost_number_target'];
            //multiply and get  the total price
            $totalPrice =  $price_amount * $targetAccount;

            if($clientInfo){

                if($transaction = TransactionDetailQueryBuilder::createTransactionDetail($request, $clientInfo->id,  $transaction_details_number, $totalPrice)){

                    $transactionId = $transaction->id;
                    return redirect()->route('previous_client_available', ['transaction' => $transactionId]);
                }else{
                    //error report
                }

            }else{

                if($client = ClientQueryBuilder::createClient($request)){

                    if($transaction = TransactionDetailQueryBuilder::createTransactionDetail($request, $client->id,  $transaction_details_number, $totalPrice)){

                        $totalAccounts = $accounts->count();
                        $totalTargetAccounts = $request['client_boost_number_target'];
                        $transactionId = $transaction->id;

                        if($totalTargetAccounts > $totalAccounts){
                            //create pending
                            $status = 'pending';
                            PendingQueryBuilder::create($status, $transactionId);
                        }

                        return redirect()->route('account-available', ['transaction' => $transactionId]);
                    }
                }
            }
        }
    }

    public function pending_transaction(){

        $data['pendingTransactions'] = array();

        $pendingTransactionData = ClientQueryBuilder::getClientsTransactions('unused');

        foreach ($pendingTransactionData as $key => $value) {

            $transactionId = $value->transactionId;

            $remainingData = ClientQueryBuilder::getPendingData($transactionId, 'unused');
            $useData = ClientQueryBuilder::getPendingData($transactionId, 'used');
            $account = ClientQueryBuilder::getPendingTotalAccountGive($transactionId);

            $transaction_details_number = $value->transaction_details_number;
            $client_social_media_account_name = $value->client_social_media_account_name;
            $remainingCount = $remainingData->count();
            $usedCount = $useData->count();
            $client_email = $value->client_email;
            $client_boost_number_target = $value->client_boost_number_target;
            $totalAccount = $account->count();

            array_push(
                $data['pendingTransactions'],
                array(
                    'transactionId' => $transactionId,
                    'remainingCount' => $remainingCount,
                    'usedCount' => $usedCount,
                    'totalAccount' => $totalAccount,
                    'client_email' => $client_email,
                    'client_social_media_account_name' => $client_social_media_account_name,
                    'transaction_details_number' => $transaction_details_number,
                    'client_boost_number_target' => $client_boost_number_target
                )
            );
        }

        return view('Content.Components.CMS.pending-transactions', $data);
    }

    public function done_transaction(){

        $data['doneTransactions'] = array();

        $pendingTransactionData = ClientQueryBuilder::getClientsTransactions('used');

        foreach ($pendingTransactionData as $key => $value) {

            $transactionId = $value->transactionId;

            $remainingData = ClientQueryBuilder::getPendingData($transactionId, 'unused');
            $useData = ClientQueryBuilder::getPendingData($transactionId, 'used');
            $account = ClientQueryBuilder::getPendingTotalAccountGive($transactionId);

            $transaction_details_number = $value->transaction_details_number;
            $client_social_media_account_name = $value->client_social_media_account_name;
            $remainingCount = $remainingData->count();
            $usedCount = $useData->count();
            $client_email = $value->client_email;
            $client_boost_number_target = $value->client_boost_number_target;
            $totalAccount = $account->count();

            array_push(
                $data['doneTransactions'],
                array(
                    'transactionId' => $transactionId,
                    'remainingCount' => $remainingCount,
                    'usedCount' => $usedCount,
                    'totalAccount' => $totalAccount,
                    'client_email' => $client_email,
                    'client_social_media_account_name' => $client_social_media_account_name,
                    'transaction_details_number' => $transaction_details_number,
                    'client_boost_number_target' => $client_boost_number_target
                )
            );
        }

        return view('Content.Components.CMS.done-transactions', $data);
    }

    public function lacking_transaction(){

        $data['lackingTransaction'] = array();

        $lackingTransaction = ClientQueryBuilder::getClientsLackingTransactions('pending');

        foreach ($lackingTransaction as $key => $value) {

            $transactionId = $value->transactionId;

            $remainingData = ClientQueryBuilder::getPendingData($transactionId, 'unused');
            $useData = ClientQueryBuilder::getPendingData($transactionId, 'used');
            $account = ClientQueryBuilder::getPendingTotalAccountGive($transactionId);

            $transaction_details_number = $value->transaction_details_number;
            $client_social_media_account_name = $value->client_social_media_account_name;
            $remainingCount = $remainingData->count();
            $usedCount = $useData->count();
            $client_email = $value->client_email;
            $client_boost_number_target = $value->client_boost_number_target;
            $totalAccount = $account->count();

            array_push(
                $data['lackingTransaction'],
                array(
                    'transactionId' => $transactionId,
                    'remainingCount' => $remainingCount,
                    'usedCount' => $usedCount,
                    'totalAccount' => $totalAccount,
                    'client_email' => $client_email,
                    'client_social_media_account_name' => $client_social_media_account_name,
                    'transaction_details_number' => $transaction_details_number,
                    'client_boost_number_target' => $client_boost_number_target
                )
            );
        }

        return view('Content.Components.CMS.lacking', $data);
    }
}
