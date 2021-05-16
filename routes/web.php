<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\Web\CMS\SocialMediaPlatformController;
use App\Http\Controllers\Main\Web\CMS\ServiceCategoryController;
use App\Http\Controllers\Main\Web\CMS\SimNetworkController;
use App\Http\Controllers\Main\Web\CMS\SimcardController;
use App\Http\Controllers\Main\Web\CMS\EmailController;
use App\Http\Controllers\Main\Web\CMS\PasswordController;
use App\Http\Controllers\Main\Web\CMS\ClientController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//dash case in route and route name
//snake case in contoller function name

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function(){

    //service category
    Route::prefix('social-media')->group(function () {
        Route::get('social-media-category', [SocialMediaPlatformController::class, 'index'])->name('social-media-category');
    });

    //service category
    Route::prefix('service-category')->group(function () {
        Route::get('service-category-list', [ServiceCategoryController::class, 'index'])->name('service-category-list');
        Route::post('submit-service-category', [ServiceCategoryController::class, 'submit_service_category'])->name('submit-service-category');
        Route::get('delete-service-category', [ServiceCategoryController::class, 'delete_service_category'])->name('delete-service-category');
    });

    //network
    Route::prefix('network')->group(function () {
        Route::get('network-list', [SimNetworkController::class, 'index'])->name('network-list');
    });

    //sim
    Route::prefix('sim-management')->group(function () {
        Route::get('simcard-list', [SimcardController::class, 'index'])->name('simcard-list');
        Route::post('submit-simcard-list', [SimcardController::class, 'submit_simcard'])->name('submit-simcard-list');
        // Route::get('delete-sim', [SimcardController::class, 'delete_number'])->name('delete-sim');
        Route::get('delete-sim', [SimcardController::class, 'moveToTrash'])->name('delete-sim');
        Route::get('undo-remove-sim', [SimcardController::class, 'undoRemove'])->name('undo-remove-sim');
        Route::get('trash-sim', [SimcardController::class, 'trash_number'])->name('trash-sim');
    });

    //email
    Route::prefix('email-account')->group(function () {
        Route::get('email-list', [EmailController::class, 'index'])->name('email-list');
        Route::get('add-email', [EmailController::class, 'add_email'])->name('add-email');
        Route::get('sim/registered-email', [EmailController::class, 'viewEmailsRegistered'])->name('registered-email-in-sim');
        Route::get('sim/registered-email/info', [EmailController::class, 'registeredEmailInfo'])->name('registered-email-info');
        Route::post('submit-email-account', [EmailController::class, 'submit_email_account'])->name('submit-email-account');
    });

    //pasword
    Route::prefix('password')->group(function () {
        Route::post('submit-password', [PasswordController::class, 'submit_password'])->name('submit-password');
    });

    //transactions
    Route::prefix('transactions')->group(function () {
        Route::get('client/new/add-client', [ClientController::class, 'create_new_client'])->name('add-new-cient');
        Route::post('client/new/add-client/submit', [ClientController::class, 'submit_new_client'])->name('add-new-cient-submit');
    });


});
