<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MoneySetupController;
use App\Http\Controllers\InsuranceProviderController;
use App\Http\Controllers\SettingController;

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

// Example Routes
Route::get('/', 'HomeController@index')->name('/');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/pricing', 'HomeController@pricing')->name('pricing');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blog-detail', 'HomeController@blog_detail')->name('blog-detail');

Route::get('/appointment', 'HomeController@appointment')->name('appointment');
Route::get('/search-professionals', 'HomeController@search_professionals')->name('search-professionals');
Route::get('/team', 'HomeController@team')->name('team');
Route::get('/testimonials', 'HomeController@testimonials')->name('testimonials');
Route::get('/insurance-prviders', 'HomeController@insurance_prviders')->name('insurance-prviders');

Route::middleware(['auth'])->group(function () {
    Route::match(['get', 'post'], '/dashboard', function(){
        return view('dashboard');
    });

    Route::view('/pages/slick', 'pages.slick');
    Route::view('/pages/datatables', 'pages.datatables');
    Route::view('/pages/blank', 'pages.blank');

    Route::get('/doctor', [DoctorController::class, 'index']);
    Route::get('/add-doctor', [DoctorController::class, 'add'])->name('add-doctor');
    Route::post('/store-doctor', [DoctorController::class, 'store'])->name('store-doctor');
    Route::get('/edit-doctor/{id}', [DoctorController::class, 'edit'])->name('edit-doctor');
    Route::post('/update-doctor/{id}', [DoctorController::class, 'update'])->name('update-doctor');

    Route::get('/insurance-providers', [InsuranceProviderController::class, 'index']);
    Route::get('/add-ins', [InsuranceProviderController::class, 'add'])->name('add-ins');
    Route::post('/store-ins', [InsuranceProviderController::class, 'store'])->name('store-ins');
    Route::get('/edit-ins/{id}', [InsuranceProviderController::class, 'edit'])->name('edit-ins');
    Route::post('/update-ins/{id}', [InsuranceProviderController::class, 'update'])->name('update-ins');

    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/add-patient', [PatientController::class, 'add'])->name('add-patient');
    Route::post('/store-patient', [PatientController::class, 'store'])->name('store-patient');
    Route::get('/edit-patient/{id}', [PatientController::class, 'edit'])->name('edit-patient');
    Route::post('/update-patient/{id}', [PatientController::class, 'update'])->name('update-patient');
    
    Route::get('/all-appointments', [DoctorController::class, 'all_appointments']);
    
    Route::get('/delete-user/{id}', [DoctorController::class, 'destroy'])->name('delete-user');
    
    Route::get('/home-settings', [ServiceController::class, 'home_settings'])->name('home-settings');

    Route::get('/key-settings', [SettingController::class, 'key_settings'])->name('key-settings');
    Route::post('/update-settings/{id}', [SettingController::class, 'update_settings'])->name('update-settings');
    Route::post('/update-paypal-keys/{id}', [SettingController::class, 'update_paypal_keys'])->name('update-paypal-keys');
    
    Route::get('/add-service', [ServiceController::class, 'add'])->name('add-service');
    Route::post('/store-service', [ServiceController::class, 'store'])->name('store-service');
    Route::get('/edit-service/{id}', [ServiceController::class, 'edit'])->name('edit-service');
    Route::post('/update-service/{id}', [ServiceController::class, 'update'])->name('update-service');
    Route::get('/delete-service/{id}', [ServiceController::class, 'destroy'])->name('delete-service');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/make-appointment', [HomeController::class, 'make_appointment'])->name('make-appointment');

Route::post('/stripe/charge', [MoneySetupController::class, 'postPaymentStripe'])->name('stripe');

Route::post('process-transaction', [MoneySetupController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [MoneySetupController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [MoneySetupController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('/success', function(){
    return view('front.payment-success');
});
Route::get('/error', function(){
    return view('front.payment-error');
});

Route::get('test-mail', [MoneySetupController::class, 'testEmail'])->name('testEmail');