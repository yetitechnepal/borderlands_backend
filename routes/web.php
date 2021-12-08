<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FullCalendarEventMasterController;


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

// admin
Route::resource('/admin-login', AdminLoginController::class);
Route::post('/check', [AdminLoginController::class,'check'])->name('login.check');
Route::get('/logout',[AdminLoginController::class,'logout'])->name('logout');

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::resource('/adminDashboard', AdminController::class);
    Route::get('/adminBanner', [AdminController::class,'getBanner']);
    Route::post('/adminBannerAdd', [AdminController::class,'addBanner'])->name('banner.add');
    Route::post('/saveBanner', [AdminController::class,'saveBanner'])->name('banner.save');
    Route::post('/bannerDestroy', [AdminController::class,'bannerDestroy'])->name('banner.destroy');

    Route::get('/adminTestimonial', [AdminController::class,'getTestimonials']);
    Route::post('/adminTestimonialAdd', [AdminController::class,'addTestimonial'])->name('testimonial.add');
    Route::post('/testimonialsDestroy', [AdminController::class,'testimonialsDestroy'])->name('testimonial.destroy');
    Route::post('/saveTestimonial', [AdminController::class,'saveTestimonial'])->name('testimonial.save');

    Route::get('/adminVideo', [AdminController::class,'getVideos']);
    Route::post('/adminVideoAdd', [AdminController::class,'addVideo'])->name('video.add');
    Route::post('/videosDestroy', [AdminController::class,'videosDestroy'])->name('video.destroy');
    Route::post('/saveVideo', [AdminController::class,'saveVideo'])->name('video.save');

    Route::get('/adminCompany', [AdminController::class,'getCompanies']);
    Route::post('/adminCompanyAdd', [AdminController::class,'addCompany'])->name('company.add');
    Route::post('/companyDestroy', [AdminController::class,'companyDestroy'])->name('company.destroy');
    Route::post('/saveCompany', [AdminController::class,'saveCompany'])->name('company.save');

    Route::get('/adminCompanyDetail/{id}', [AdminController::class,'getCompanyDetail']);
    Route::post('/addService', [AdminController::class,'addService'])->name('service.add');
    Route::post('/saveService', [AdminController::class,'saveService'])->name('service.save');
    Route::post('/serviceDestroy', [AdminController::class,'serviceDestroy'])->name('service.destroy');

    Route::get('/adminPackages/{id}', [AdminController::class,'getPackages']);
    Route::post('/saveService', [AdminController::class,'saveService'])->name('package.save');
    Route::post('/addPackages', [AdminController::class,'addPackages'])->name('package.add');
    Route::post('/savePackages', [AdminController::class,'savePackages'])->name('package.save');
    Route::post('/packageDestroy', [AdminController::class,'packageDestroy'])->name('package.destroy');

    Route::get('/adminPackageQuickdates/{id}', [AdminController::class,'getQuickDates']);
    Route::post('/addQuickdates', [AdminController::class,'addQuickdates'])->name('quickdates.add');
    Route::post('/quickdatesDestroy', [AdminController::class,'quickdatesDestroy'])->name('quickdates.destroy');

    Route::get('/adminWhatsIncluded/{id}', [AdminController::class,'getWhatsIncluded']);
    Route::post('/addWhatsIncluded', [AdminController::class,'addWhatsIncluded'])->name('whatsincluded.add');
    Route::post('/whatsincludedDestroy', [AdminController::class,'whatsincludedDestroy'])->name('whatsincluded.destroy');

    //fullcalender
    Route::get('/fullcalendareventmaster',[FullCalendarEventMasterController::class,'index']);
    Route::post('/fullcalendareventmaster/create',[FullCalendarEventMasterController::class,'create']);
    Route::post('/addEvent', [FullCalendarEventMasterController::class,'addEvent'])->name('event.add');
    Route::post('/fullcalendareventmaster/update',[FullCalendarEventMasterController::class,'update']);
    Route::post('/fullcalendareventmaster/delete',[FullCalendarEventMasterController::class,'destroy']);

    Route::get('/bookings', [AdminController::class,'getBookings']);
    Route::post('/pastBookings', [AdminController::class,'pastBookings'])->name('pastBookings');
    Route::post('/saveBooking', [AdminController::class,'saveBooking'])->name('booking.save');
   
    Route::get('/adminOffer', [AdminController::class,'getOffer']);
    Route::post('/adminOfferAdd', [AdminController::class,'addOffer'])->name('offer.add');
    Route::post('/offerDestroy', [AdminController::class,'offerDestroy'])->name('offer.destroy');
    Route::post('/saveOffer', [AdminController::class,'saveOffer'])->name('offer.save');
});
