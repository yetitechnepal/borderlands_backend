<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getBanners',[HomeController::class,'getBanners']);
Route::get('/getTestimonials',[HomeController::class,'getTestimonials']);
Route::get('/getTopDeals',[HomeController::class,'getTopDeals']);
Route::get('/getCompanies/{id}',[HomeController::class,'getCompanies']);
Route::get('/getPackages/{id}/{type}',[HomeController::class,'getPackages']);
Route::get('/getPackageDetail/{id}',[HomeController::class,'getPackageDetail']);
Route::get('/getHighLights',[HomeController::class,'getHighLights']);
Route::get('/getExploreVideos',[HomeController::class,'getExploreVideos']);
Route::get('/getCompanyHotDeals/{id}',[HomeController::class,'getCompanyHotDeals']);
Route::post('/makeBooking',[HomeController::class,'makeBooking']);
Route::post('/paymentSuccess',[HomeController::class,'paymentSuccess']);
Route::get('/getEvents',[HomeController::class,'getEvents']);
Route::get('/getCodes',[HomeController::class,'getCodes']);

