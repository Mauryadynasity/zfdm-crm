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
    // -------Setting Route---------------//
    Route::get('setting', [Admin\SettingController::class,'index'])->middleware('admin');
    Route::post('save-setting', [Admin\SettingController::class,'saveSetting'])->middleware('admin');
    Route::get('status-master', [Admin\MasterController::class,'index'])->middleware('admin');
    Route::post('status-master', [Admin\MasterController::class,'saveStatus'])->middleware('admin');
    Route::post('save-color-setting', [Admin\MasterController::class,'saveColorSetting'])->middleware('admin');
    Route::post('quotation-setting', [Admin\SettingController::class,'quotationSetting'])->middleware('admin');
    Route::post('footer-text', [Admin\SettingController::class,'saveFooterText'])->middleware('admin');
    Route::group(['middleware'=>['admin','setting']], function () {
        Route::get('user-list', [Admin\UserController::class,'index']);
        Route::post('save-user', [Admin\UserController::class,'store']);
        Route::get('delete-user/{id}', [Admin\UserController::class,'destroy']);
        Route::get('dashboard', [Admin\DashboardController::class,'dashboard']);
        Route::get('user-dashboard', [Admin\DashboardController::class,'userDashboard']);
        Route::get('add-new-quotation', [Admin\DashboardController::class,'addNewOffer']);


    // -------Prospact Route---------------//
        Route::get('prospact-list', [Admin\ProspactController::class,'prospactList']);
        Route::get('add-prospact', [Admin\ProspactController::class,'addProspact']);
        Route::post('save-prospact', [Admin\ProspactController::class,'saveProspact']);
        Route::get('is-email-unique', [Admin\ProspactController::class,'isEmailUnique']);
        Route::get('is-phone-unique', [Admin\ProspactController::class,'isPhoneUnique']);
        Route::get('is-email-unique-edit', [Admin\ProspactController::class,'isEmailUniqueEdit']);
        Route::get('is-phone-unique-edit', [Admin\ProspactController::class,'isPhoneUniqueEdit']);
        Route::get('edit-prospact/{id}', [Admin\ProspactController::class,'editProspact']);
        Route::post('update-prospact', [Admin\ProspactController::class,'updateProspact']);
        Route::get('delete-prospact/{id}', [Admin\ProspactController::class,'destroy']);
        Route::get('internet-prospect', [Admin\ProspactController::class,'internetProspectForm']);
        // protocal routes
        Route::get('get-protocals', [Admin\ProspactController::class,'getProtocals']);

        // -------Quotation Route---------------//
        Route::get('get-prospact-details', [Admin\QuotationController::class,'getOfferDetail']);
        Route::post('save-quotation', [Admin\QuotationController::class,'saveQuotation']);
        Route::get('quotation-list', [Admin\QuotationController::class,'quotationList']);
        Route::get('view-quotation/{id}', [Admin\QuotationController::class,'viewQuotation']);
        Route::get('edit-quotation/{id}', [Admin\QuotationController::class,'editQuotation']);
        Route::post('edit-quotation/{id}', [Admin\QuotationController::class,'updateQuotation']);
        Route::get('delete-quotation/{id}', [Admin\QuotationController::class,'destroy']);
        Route::get('invoice/{id}', [Admin\QuotationController::class,'invoice']);

        // -------Permission Route---------------//
        Route::get('prospect-permission', [Admin\PermissionController::class,'prospectPermission']);
        Route::post('prospect-permission', [Admin\PermissionController::class,'savePermission']);
    });
    

    // -------Change Password Route---------------//
    Route::get('change-password', [Admin\LoginController::class,'changePassword'])->name('admin.changePassword');
    Route::post('change-password/save', [Admin\LoginController::class,'changePasswordSave'])->name('admin.changePasswordSave');


