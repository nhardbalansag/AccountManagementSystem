<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\Client\Query\ClientQueryBuilder;
use Illuminate\Support\Facades\Validator;
use App\Main\Model\SubscriptionAccount\Query\SubscriptionAccountQueryBuilder;
use App\Main\Model\TransactionDetail\Query\TransactionDetailQueryBuilder;

class ClientController extends Controller
{
    public function create_new_client(){

        $data['serviceCategory'] = ClientQueryBuilder::getTableData('service_categories', 'active', 'service_category_status');

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

            if($client = ClientQueryBuilder::createClient($request)){

                $data = ClientQueryBuilder::getTableData('transaction_details', null, null);
                $transactionCount = $data->count() + 1;

                if($transaction = TransactionDetailQueryBuilder::createTransactionDetail($request, $client->id,  $transactionCount)){
                    return redirect()->back()->with('success', 'data added');
                }
            }
        }
    }
}
