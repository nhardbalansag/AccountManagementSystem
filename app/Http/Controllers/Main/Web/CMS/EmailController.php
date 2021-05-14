<?php

namespace App\Http\Controllers\Main\Web\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main\Model\Email\Query\QueryBuilder;
use App\Main\Model\Password\Query\PasswordQueryBuilder;
use App\Main\Model\Account\Query\AccountQueryBuilder;
use Illuminate\Support\Facades\Validator;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class EmailController extends Controller
{
    public function index(){

        $data['accounts'] = QueryBuilder::getEmailAccounts();

        return view('Content.Components.CMS.email-list', $data);
    }

    public function viewEmailsRegistered(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'sim'){

            $data['accounts'] = QueryBuilder::getEmailRegisteredInNumber($_GET['sim']);

            return view('Content.Components.CMS.accounts-registered', $data);

        }else{

            return redirect()->back();
        }
    }

    public function registeredEmailInfo(){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'account'){

            $accountId = $_GET['account'];

            $data['accounts'] = QueryBuilder::getTableDataFirst('accounts', $accountId, 'id');
            $data['email'] = QueryBuilder::getTableDataFirst('emails', $data['accounts']->emailid, 'id');
            $data['password'] = QueryBuilder::getTableData('passwords', $data['email']->id, 'emailid');

            return view('Content.Components.CMS.account-info', $data);

        }else{
            return redirect()->back();
        }
    }

    public function add_email(Faker $faker){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'simcard'){

            $data['firstname'] = $faker->unique()->firstName();
            $data['lastname'] = $faker->unique()->lastName();
            $data['birthday'] = $faker->date($format = 'Y-m-d', $max = 'now');
            $data['emailaddress'] = strtolower($data['firstname'] . $data['lastname'] . "." . "boosterph@gmail.com");

            $data['password'] = base64_encode("@" . $data['firstname'] . $data['lastname'] .  $data['birthday']);

            $data['simcardId'] = $_GET['simcard'];

            $data['accounts'] = AccountQueryBuilder::SimAccounts($_GET['simcard']);

            return view('Content.Components.CMS.add-google-account', $data);

        }else{

            return redirect()->back();

        }
    }

    public function submit_email_account(Request $request){

        $getVars = array_keys($_GET);

        if($getVars[0] === 'simcard'){

            $rules = [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'emailaddress' => ['required', 'string', 'email', 'max:255', 'unique:emails'],
                'emailbirthday' => ['required', 'date'],
                'status' => ['required', 'string'],
                'password' => ['required', 'string']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return redirect()->back()->with('error', 'Error adding data');

            }else{

                unset($request['_token']);

                if($emailData = QueryBuilder::registerEmail($request)){

                    if(PasswordQueryBuilder::createEmailPassword($request, $emailData->id)){

                        if(AccountQueryBuilder::createAccount($request, $emailData->id, $_GET['simcard'])){
                            return redirect()->back()->with('success', 'data added');
                        }
                    }
                }
            }

        }else{
            return redirect()->back();
        }
    }

}
