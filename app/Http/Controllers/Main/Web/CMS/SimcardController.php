<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\Simcard\Query\QueryBuilder;
use Illuminate\Support\Facades\Validator;

class SimcardController extends Controller
{
    public function index(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'network'){

            $data['network_id'] = $_GET['network'];

            $data['registeredNumber'] = QueryBuilder::getall($data['network_id']);
            $data['network'] = QueryBuilder::getData('sim_net_works', 'id', $data['network_id']);

            return view('Content.Components.CMS.simcard-list', $data);

        }else{

            return redirect()->back();

        }
    }

    public function submit_simcard(Request $request){

        $getVars = array_keys($_GET);



        if($getVars[0] === 'network'){

            $rules = [
                'sim_number' => ['required', 'numeric', 'min:11'],
                'sim_description' => ['required', 'string'],
                'sim_status' => ['required', 'string', 'max:20']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return redirect()->back()->with('error', 'Error adding data');

            }else{

                unset($request['_token']);

                $data['network'] = QueryBuilder::getData('sim_net_works', 'id', $_GET['network']);

                $data['registeredNumber'] = QueryBuilder::getall($_GET['network']);

                $simcardName = $data['network']->networkname . " network " . ($data['registeredNumber']->count() + 1);

                if(QueryBuilder::submit_simcard($request, $_GET['network'], $simcardName)){
                    return redirect()->back()->with('success', 'data added');
                }
            }

        }else{
            return redirect()->back();
        }
    }


    public function delete_number(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'sim'){

            if(QueryBuilder::deleteData('simcards', $_GET['sim'])){
                return redirect()->back()->with('success', 'data deleted');
            }

        }else{
            return redirect()->back();
        }
    }
}
