<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Illuminate\Http\Request;
use Exception;
use App\User;

class GoogleCreateLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        try {

            $newUser = User::create([
                'firstname' => $user->user['given_name'],
                'middlename' => "testGoogle",
                'lastname'=> $user->user['family_name'],
                'status' => "active",
                'role' => "account",
                'google_id' => $user->id,
                'email' => $user->email,
                'password' => encrypt('helloworld')
            ]);

        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return view('Content.Components.CMS.dashboard');
    }
}
