<?php

use App\Http\Controllers\UploadImage;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    Storage::disk('yomna')->put('test.txt', 'welcom');
    return "ok";
    // return view('welcome');
});

Route::get('show', [UploadImage::class, 'showform']);
Route::get('show/image', [UploadImage::class, 'index']);
Route::post('store', [UploadImage::class, 'store'])->name('photo.save');


