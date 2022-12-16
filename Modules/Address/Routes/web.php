<?php

use Illuminate\Support\Facades\Route;
use Modules\Address\Services\AddressService;

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

Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('address', AddressController::class);
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('address/get-barangays-per-city-muniicpality/{city_code}', function($city_code) {

        return AddressService::getBarangaysPerCity($city_code);
    });

    Route::get('address/get-cities-municipalities-per-province/{province_code}', function($province_code) {

        return AddressService::getCityPerProvince($province_code);
    });
});
