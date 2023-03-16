<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;


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

    Route::get('/', function () {
        return view('admin.login');
    });
    
    // Route::get('/', [Admin\LoginController::class,'index']);
    Route::post('login', [Admin\LoginController::class,'login']);
    Route::get('logout', [Admin\LoginController::class,'logout']);
    Route::group(['middleware'=>'admin'], function () {
        Route::get('user-list', [Admin\UserController::class,'index']);
        Route::post('save-user', [Admin\UserController::class,'store']);
        Route::get('delete-user/{id}', [Admin\UserController::class,'destroy']);
        Route::get('dashboard', [Admin\DashboardController::class,'dashboard']);
        Route::get('user-dashboard', [Admin\DashboardController::class,'userDashboard']);
        Route::get('add-new-offer', [Admin\DashboardController::class,'addNewOffer']);

    // -------Setting Route---------------//
        Route::get('setting', [Admin\SettingController::class,'index']);
        Route::post('save-setting', [Admin\SettingController::class,'saveSetting']);

        // -------Offer Route---------------//
        Route::post('save-offer', [Admin\OfferController::class,'saveOffer']);
        Route::get('get-offer-details', [Admin\OfferController::class,'getOfferDetail']);
        Route::get('invoice', [Admin\OfferController::class,'invoice']);
    });
    

    // -------Change Password Route---------------//
    Route::get('change-password', [Admin\LoginController::class,'changePassword'])->name('admin.changePassword');
    Route::post('change-password/save', [Admin\LoginController::class,'changePasswordSave'])->name('admin.changePasswordSave');


