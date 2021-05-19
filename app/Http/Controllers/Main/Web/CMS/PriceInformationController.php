<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\Price\Query\PriceInformationQueryBuilder;
use Illuminate\Support\Facades\Validator;

class PriceInformationController extends Controller
{

    public function index(){

        $model = 'price_information';
        $filterId = null;
        $columnName = null;

        $data['priceInformation'] = PriceInformationQueryBuilder::getTableData($model, $filterId, $columnName);

        return view('Content.Components.CMS.price-information', $data);
    }

    public function create_price(Request $request){

        $rules = [
            'price' => ['required', 'numeric'],
            'price_status' => ['required', 'string', 'max:20']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->back()->with('error', 'Error adding data');

        }else{

            unset($request['_token']);

            if(PriceInformationQueryBuilder::create($request)){
                return redirect()->back()->with('success', 'data added');
            }
        }
    }
}
