<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

##-------------------------------------Auth Module
Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});


##-------------------------------------Settings Module
Route::get('/settings', SettingController::class);

##------------------------------------- Cities Module
Route::get('/cities', CitiesController::class);

##------------------------------------- Districts Module
Route::get('/district', DistrictController::class);

##------------------------------------- Message Module
Route::post('/message', MessageController::class);

##------------------------------------- Domain Module
Route::get('/domain', DomainController::class);

##------------------------------------- Ads Module
Route::prefix('ads')->controller(AdController::class)->group(function(){
    //basic route

    Route::get('/', 'index');   //بجيب صفهحه الاعلانات كلها 

    Route::get('/latest', 'latest'); //نجيب الاعلانات الاحدث

    Route::get('/domain/{domain_id}', 'domain'); // domain بظهر كل الاعلانات الي موجوده حسب كل 
    Route::get('/search', 'search');   // عمليه البحث جو الاعلانات المبوبه

    //user Api Ads Endpoint
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create', 'create');
        Route::post('/update/{adId}', 'update');
        Route::get('/delete/{adId}', 'delete');
        Route::get('/myads', 'myads'); // بجيب الاعلانات الخاصه بالمستخدم بس من الداتا بيس
    });
});
