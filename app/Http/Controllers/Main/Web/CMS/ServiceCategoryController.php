<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\ServiceCategory\Query\QueryBuilder;
use Illuminate\Support\Facades\Validator;

    class ServiceCategoryController extends Controller
{
    public function index(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'platform'){

            $platformId['platform_id'] = $_GET['platform'];

            $data['serviceCategory'] = QueryBuilder::getall($platformId['platform_id']);
            $data['social_media_platforms'] = QueryBuilder::getData('social_media_platforms', $platformId['platform_id'], "id");

            return view('Content.Components.CMS.service-category', $data);

        }else{

            return redirect()->back();

        }
    }

    public function submit_service_category(Request $request){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'platform'){

            $rules = [
                'service_category_name' => ['required', 'string'],
                'service_category_description' => ['required', 'string'],
                'service_category_status' => ['required', 'string', 'max:10']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return redirect()->back()->with('error', 'Error adding data');

            }else{

                unset($request['_token']);

                if(QueryBuilder::createServiceCategory($request, $_GET['platform'])){
                    return redirect()->back()->with('success', 'data added');
                }
            }

        }else{
            return redirect()->back();
        }
    }

    public function delete_service_category(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'category'){

            if(QueryBuilder::deleteServiceCategory('service_categories', $_GET['category'])){
                return redirect()->back()->with('success', 'data deleted');
            }

        }else{
            return redirect()->back();
        }
    }
}
