<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\Web\CMS\SocialMediaPlatformController;
use App\Http\Controllers\Main\Web\CMS\ServiceCategoryController;
use App\Http\Controllers\Main\Web\CMS\SimNetworkController;
use App\Http\Controllers\Main\Web\CMS\SimcardController;


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
        Route::get('delete-sim', [SimcardController::class, 'delete_number'])->name('delete-sim');
    });


});
