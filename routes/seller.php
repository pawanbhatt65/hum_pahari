<?php

use App\Http\Controllers\Seller\HomeStayeController;
use App\Http\Controllers\Seller\RegisteredUser;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'verified', 'role:seller']], function () {
    Route::get('/dashboard', [SellerController::class, 'getDashboard'])->name('seller.dashboard');
    // home stay list data route
    Route::get('/homestays/home-stay-list', [HomeStayeController::class, 'homeStayList'])->name('homestays.homeStayList');
    Route::put('/homestays/{id}/approve', [HomeStayeController::class, 'updateApproval'])->name('homestays.approve');

    // homestay benefits
    Route::get('/homestays/{id}/benefits', [HomeStayeController::class, 'benefits'])->name('homestays.benefits');
    Route::get('/homestays/{id}/benefit/add', [HomeStayeController::class, 'getAddNewBenefit'])->name('homestays.getAddNewBenefit');
    Route::post('/homestays/{id}/benefit/add', [HomeStayeController::class, 'postAddNewBenefit'])->name('homestays.postAddNewBenefit');
    Route::get('/homestays/{id}/benefit/edit/{benefit_id}', [HomeStayeController::class, 'getEditBenefit'])->name('homestays.getEditBenefit');
    Route::put('/homestays/{id}/benefit/edit/{benefit_id}', [HomeStayeController::class, 'putEditBenefit'])->name('homestays.putEditBenefit');
    Route::delete('/homestays/{id}/benefit/delete/{benefit_id}', [HomeStayeController::class, 'deleteBenefit'])->name('homestays.deleteBenefit');

    // homestay common spaces
    Route::get('/homestays/{id}/common-spaces', [HomeStayeController::class, 'commonSpaceses'])->name('homestays.commonSpaceses');
    Route::get('/homestays/{id}/common-spaces/add', [HomeStayeController::class, 'getAddNewCommonSpace'])->name('homestays.getAddNewCommonSpace');
    Route::post('/homestays/{id}/common-spaces/add', [HomeStayeController::class, 'postAddNewCommonSpace'])->name('homestays.postAddNewCommonSpace');
    Route::get('/homestays/{id}/common-spaces/edit/{common_spaces_id}', [HomeStayeController::class, 'getEditCommonSpace'])->name('homestays.getEditCommonSpace');
    Route::put('/homestays/{id}/common-spaces/edit/{common_spaces_id}', [HomeStayeController::class, 'putEditCommonSpace'])->name('homestays.putEditCommonSpace');
    Route::delete('/homestays/{id}/common-spaces/delete/{common_spaces_id}', [HomeStayeController::class, 'deleteCommonSpace'])->name('homestays.deleteCommonSpace');

    // homestay: Safety & Security
    Route::get('/homestays/{id}/safety-security', [HomeStayeController::class, 'safetySecurities'])->name('homestays.safetySecurities');
    Route::get('/homestays/{id}/safety-security/add', [HomeStayeController::class, 'getAddNewSafetySecurity'])->name('homestays.getAddNewSafetySecurity');
    Route::post('/homestays/{id}/safety-security/add', [HomeStayeController::class, 'postAddNewSafetySecurity'])->name('homestays.postAddNewSafetySecurity');
    Route::get('/homestays/{id}/safety-security/edit/{safety_security_id}', [HomeStayeController::class, 'getEditSafetySecurity'])->name('homestays.getEditSafetySecurity');
    Route::put('/homestays/{id}/safety-security/edit/{safety_security_id}', [HomeStayeController::class, 'putEditSafetySecurity'])->name('homestays.putEditSafetySecurity');
    Route::delete('/homestays/{id}/safety-security/delete/{safety_security_id}', [HomeStayeController::class, 'deleteSafetySecurity'])->name('homestays.deleteSafetySecurity');

    // homestay: bedding
    Route::get('/homestays/{id}/beddings', [HomeStayeController::class, 'beddings'])->name('homestays.beddings');
    Route::get('/homestays/{id}/bedding/add', [HomeStayeController::class, 'getAddNewBedding'])->name('homestays.getAddNewBedding');
    Route::post('/homestays/{id}/bedding/add', [HomeStayeController::class, 'postAddNewBedding'])->name('homestays.postAddNewBedding');
    Route::get('/homestays/{id}/bedding/edit/{bedding_id}', [HomeStayeController::class, 'getEditBedding'])->name('homestays.getEditBedding');
    Route::put('/homestays/{id}/bedding/edit/{bedding_id}', [HomeStayeController::class, 'putEditBedding'])->name('homestays.putEditBedding');
    Route::delete('/homestays/{id}/bedding/delete/{bedding_id}', [HomeStayeController::class, 'deleteBedding'])->name('homestays.deleteBedding');

    // homestay: bedding
    Route::get('/homestays/{id}/images', [HomeStayeController::class, 'images'])->name('homestays.images');
    Route::get('/homestays/{id}/image/add', [HomeStayeController::class, 'getAddNewImage'])->name('homestays.getAddNewImage');
    Route::post('/homestays/{id}/image/add', [HomeStayeController::class, 'postAddNewImage'])->name('homestays.postAddNewImage');
    Route::delete('/homestays/{id}/image/delete/{image_id}', [HomeStayeController::class, 'deleteImage'])->name('homestays.deleteImage');

    // homestay: rooms image
    Route::put('/homestays/{id}/room-image', [HomeStayeController::class, 'putRoomImage'])->name('homestays.roomImage');

    Route::resource('/homestays', HomeStayeController::class);

    // handle registered users
    Route::resource('/registered-users', RegisteredUser::class)
        ->except(['show', 'create', 'store', 'edit', 'update', 'delete']);
});
