<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreLocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PartneringOrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\SpecifyProductController;
use App\Http\Controllers\DesignController;
use App\Http\Requests\EmployeeRegisterRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Models\Design;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\URL;


Route::controller( AuthController::class)->group(function(): void{

    Route::post('register', 'ownerRegister')->name('ownerRegister');

    Route::post('login', 'login')->name('login');

    Route::post('logout', 'logout')->name('logout');

    Route::get('verify-email/{id}/{hash}', 'emailVerify')->middleware('signed')->name('verification.verify');

    Route::post('resend-verification', 'resendEmailVerification')->name('verification.resend');

    // Route::post('/employee/register/{id}', 'employeeRegister')->middleware('signed')->name('employeeRegister');

    // Route::get('/generate-link/{store_id}', 'generateLink')->middleware('signed')->name('generateLink');

    Route::post('/forgot-password', 'forgotPassword')->name('password.email');

    Route::post('/reset-password', 'resetPassword')->name('password.update'); 

});

Route::controller( StoreController::class)->group(function(): void{

    Route::get('show-store/{store}','show')->name('show.store');

     Route::get('view-stores', 'index')->name('view.stores');

    Route::put('update-store/{store}', 'update')->name('update.store');

    Route::delete('destroy-store/{store}','destroy')->name('destroy.store');

});


Route::controller( StoreLocationController::class)->group(function(): void{

     Route::get('view-store-loc/{store}','view')->name('view.store.Loc');

     Route::get('view-stores-loc','index')->name('view.stores.loc');

     Route::get('show-store-locs/{storeLoc}','show')->name('show.loc');

     Route::post('store-loc', 'store')->name('store.loc');

    Route::put('update-store-loc/{storeLoc}', 'update')->name('update.loc');

    Route::delete('destroy-store-loc/{storeLoc}','destroy')->name('destroy.loc');

});


Route::get('/reset-password/{token}', function ($token) {
    return response()->json(['token' => $token]);
})->name('password.reset'); 



Route::controller( OrderController::class)->group(function(): void{

     Route::get('show-order/{order}','show')->name('show.order');

     Route::get('view-orders','index')->name('view.orders');

      Route::get('view-store-orders','view')->name('view.store.orders');

    Route::post('update-order-status/{id}', 'update')->name('update.order.status');

});

Route::controller( StatusController::class)->group(function(): void{

     Route::get('show-status/{status}','show')->name('show.status');

     Route::get('view-statuses','index')->name('view.statuses');

     Route::post('add-status', 'store')->name('add.status');

    Route::put('update-status/{status}', 'update')->name('update.status');

    Route::delete('destroy-status/{status}','destroy')->name('destroy.status');

});



Route::controller( UserController::class)->group(function(){
    Route::get('show-user', 'show')->name('show.user');

    Route::put('update-user/{user}', 'update')->name('update.user');

    Route::put('update-password/{user}', 'updatePassword')->name('update.password');

    Route::put('update-email/{user}', 'updateEmail')->name('update.email');

});

Route::apiResource('product-categories', ProductCategoryController::class);

Route::apiResource('partnering-orders', PartneringOrderController::class)->except('store');

Route::apiResource('features', FeatureController::class)->except('store');


Route::controller( FeatureController::class)->group(function(): void{

    Route::post('features/{prod_catg}', 'store')->name('features.store');
    
    Route::get('view-features/{prod_catg}','viewCategoryFeatures')->name('view.category.features');

    //  Route::post('add-status', 'store')->name('newStatus');

   //Route::post('update-order-status/{id}', 'update')->name('updateStatus');

    // Route::get('destroy-status/{status}','destroy')->name('deleteStatus');

});


Route::controller( SpecifyProductController::class)->group(function(){
    Route::get('view-store-features', 'index')->name('view.store.features');
    Route::get('show-store-feature/{feature}', 'show')->name('show.store.feature');
    Route::post('store-feature', 'store')->name('select.feature');
    Route::delete('destroy-feature/{feature}', 'destroy')->name('destroy.feature');

});


Route::controller(DesignController::class)->group(function(){
    Route::get('show-store-designs/{store}', 'indexAdmin')->name('store.designs.show.admin');
    Route::get('view-store-designs', 'indexPartner')->name('store.designs.view.partner');
    Route::get('show-design/{design}', 'show')->name('store.design.show');
    Route::get('show-feature-design/{feature}', 'showStoreDesign')->name('feature.design.show');
    Route::post('store-design', 'store')->name('add.desgin');
    Route::put('update-design/{design}', 'update')->name('update.design');
    Route::delete('destroy-design/{design}', 'destroy')->name('destroy.design');

});