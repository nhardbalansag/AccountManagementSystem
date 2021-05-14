<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Main\Model\Password\Query\PasswordQueryBuilder;

class PasswordController extends Controller
{
    public function submit_password(Request $request){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'email'){

            $email = $_GET['email'];

            PasswordQueryBuilder::updateColumn('passwords', 'active', $email, 'status', 'disable');

            $rules = [
                'password' => ['required', 'string', 'max:255']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return redirect()->back()->with('error', 'Error adding data');

            }else{

                unset($request['_token']);

                if(PasswordQueryBuilder::createEmailPassword($request, $email)){

                    return redirect()->back()->with('success', 'data added');
                }
            }

        }else{

            return redirect()->back();
        }
    }
}
