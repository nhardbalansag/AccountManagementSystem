<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\Email\Query\QueryBuilder;
use App\Main\Model\Account\Query\AccountQueryBuilder;
use App\Main\Model\SubscriptionAccount\Query\SubscriptionAccountQueryBuilder;
use App\Main\Model\Pending\Query\PendingQueryBuilder;

class AccountController extends Controller
{
    public function account_available(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'transaction'){

            $transaction = $_GET['transaction'];
            $dataArray = array();

            //get the trransaction information
            $transactionDetails = AccountQueryBuilder::getTableDataFirst('transaction_details', $transaction, 'id');
            //get the client information
            $clientDetails = AccountQueryBuilder::getTableDataFirst('clients', $transactionDetails->client_id, 'id');
            //get the target number
            $client_boost_number_target =  $transactionDetails->client_boost_number_target;

            //check if client exist
            $clientDetailsCheck = SubscriptionAccountQueryBuilder::checkClient($transactionDetails->id, $clientDetails->id );

            if( $clientDetailsCheck){

                $data['availableAccounts'] = SubscriptionAccountQueryBuilder::getEmailAccounts('unused', $transaction);
            }else{

                $account = SubscriptionAccountQueryBuilder::getTableDataLimit('accounts', 'active', 'status', $client_boost_number_target);

                foreach ($account as $key => $value) {

                    $request = array(
                        'account_id' => $value->id,
                        'service_category_id' => $clientDetails->service_category_id,
                        'transaction_details_id' => $transactionDetails->id,
                        'account_status' => "unused"
                    );

                    $data['accountAvailable'] = SubscriptionAccountQueryBuilder::createSubscriptionAccount($request);
                }

                $data['availableAccounts'] = SubscriptionAccountQueryBuilder::getEmailAccounts('unused', $transaction);
            }

            $data['client_social_media_link'] =  $clientDetails->client_social_media_link;

            return view('Content.Components.CMS.accounts-list-use', $data);

        }else{

            return redirect()->back();
        }
    }

    public function previous_client_available(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'transaction'){

            $transaction = $_GET['transaction'];
            $availableAccount = array();

            //get the trransaction information
            $transactionDetails = AccountQueryBuilder::getTableDataFirst('transaction_details', $transaction, 'id');
            //get the client information
            $clientDetails = AccountQueryBuilder::getTableDataFirst('clients', $transactionDetails->client_id, 'id');
            //get the target number
            $client_boost_number_target =  $transactionDetails->client_boost_number_target;

            //check if client exist
            $clientDetailsCheck = SubscriptionAccountQueryBuilder::checkClient($transactionDetails->id, $clientDetails->id );

            //check lacking transactions
            $lackingTransaction = AccountQueryBuilder::getTableDataFirst('pending_transactions',  $transaction, 'transaction_details_id');

            //check if client has previous transaction
            $prevTransaction = AccountQueryBuilder::getTableData('transaction_details', $clientDetails->id, 'client_id');

            if($prevTransaction){

                if( $clientDetailsCheck && empty($lackingTransaction)){

                    $data['availableAccounts'] = SubscriptionAccountQueryBuilder::getEmailAccounts('unused', $transaction);
                }else{

                    //step 1. get all active accounts
                    $activeAccounts = AccountQueryBuilder::getTableData('accounts', 'active', 'status');

                    //step 3. loop and compare to all active accounts and store in array
                    foreach ($activeAccounts as $key_active => $value_active) {
                        if(!AccountQueryBuilder::getTableDataFirst('subscription_accounts',  $value_active->id, 'account_id')){
                            array_push(
                                $availableAccount,
                                array(
                                    'account_id' => $value_active->id
                                )
                            );
                        }
                    }

                    if($client_boost_number_target > count($availableAccount) && empty($lackingTransaction)){
                        //create pending
                        $status = 'pending';
                        PendingQueryBuilder::create($status,  $transactionDetails->id);
                    }

                    $subscription_accounts = AccountQueryBuilder::getTableData('subscription_accounts', $transaction, 'transaction_details_id');

                    for ($i = 0; $i < count($availableAccount); $i++) {

                        if($i < (empty($lackingTransaction) ? $client_boost_number_target : ($client_boost_number_target - $subscription_accounts->count()))){
                            $request = array(
                                'account_id' => $availableAccount[$i]['account_id'],
                                'service_category_id' => $clientDetails->service_category_id,
                                'transaction_details_id' => $transactionDetails->id,
                                'account_status' => "unused"
                            );

                            $data['accountAvailable'] = SubscriptionAccountQueryBuilder::createSubscriptionAccount($request);

                        }
                    }

                    $subscription_accounts = AccountQueryBuilder::getTableData('subscription_accounts', $transaction, 'transaction_details_id');

                    if(!empty($lackingTransaction) && $subscription_accounts->count() === $client_boost_number_target){
                        PendingQueryBuilder::updateColumn('pending_transactions', $lackingTransaction->id, 'id', 'done', 'status');
                    }

                    $data['availableAccounts'] = SubscriptionAccountQueryBuilder::getEmailAccounts('unused', $transaction);
                }
            }

            $data['client_social_media_link'] =  $clientDetails->client_social_media_link;

            return view('Content.Components.CMS.accounts-list-use', $data);

        }else{

            return redirect()->back();
        }
    }

    public function moveToUsed(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'subscriptionAcccount'){

            $model = "subscription_accounts";
            $columnName = "account_status";
            $data = "used";
            $id =  $_GET['subscriptionAcccount'];

            if(SubscriptionAccountQueryBuilder::updateAccountStatus($model, $id, $columnName, $data)){
                return redirect()->back()->with('success', 'data updated');
            }

        }else{
            return redirect()->back();
        }
    }
}
