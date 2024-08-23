<?php

use App\Http\Controllers\CustomerAuth\LoginController;
use App\Http\Controllers\CustomerAuth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRideController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverLocation;
use App\Http\Controllers\DriverRideController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth.all')->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/driver/{id}/location', [DriverLocation::class, 'getLocation']);
});
//driver routes
Route::prefix('/driver')->group(function () {

    Route::middleware('guest:customer,driver')->group(function () {
        Route::get('/login', [\App\Http\Controllers\DriverAuth\LoginController::class, 'showLoginForm'])->name('driver.login');
        Route::post('/login', [\App\Http\Controllers\DriverAuth\LoginController::class, 'login']);
        Route::get('/register', [App\Http\Controllers\DriverAuth\RegisterController::class, 'showRegistrationForm']);
        Route::post('/register', [App\Http\Controllers\DriverAuth\RegisterController::class, 'register']);
    });
    Route::middleware(['auth.driver:driver'])->group(function () {

        Route::get('/logout',[\App\Http\Controllers\DriverAuth\LoginController::class,'logout']);
        Route::get('/profile/{id}', [DriverController::class, 'show']);
        Route::get('/profile/edit/{id}', [DriverController::class, 'edit']);
        Route::post('/profile/update/{id}', [DriverController::class, 'update']);
        Route::get('/payment', [PaymentController::class, 'driverIndex']);
        Route::get('/payment/{id}', [PaymentController::class, 'show']);
        Route::post('/{id}/location', [DriverLocation::class, 'setLocation']);

        Route::prefix('/ride')->group(function () {
            Route::get('/rating', [RatingController::class, 'driverIndex']);
            Route::get('/', [DriverRideController::class, 'index'])->name('driver.ride.index');
            Route::get('/{id}/accept', [DriverRideController::class, 'accept']);
            Route::get('/{id}/reject', [DriverRideController::class, 'reject']);
            Route::get('/{id}/complete', [DriverRideController::class, 'complete']);
            Route::get('/{id}', [DriverRideController::class, 'show']);
        });
    });

});

//customer routes
Route::prefix('/customer')->group(function () {
    //customer login routes
    Route::middleware('guest:customer,driver')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('customer.login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
        Route::post('/register', [RegisterController::class, 'register']);
    });
    //customer profile routes
    Route::middleware(['auth.customer:customer'])->group(function () {
        Route::get('/logout',[LoginController::class,'logout']);
        Route::prefix('/profile')->group(function () {
            Route::get('/{id}', [CustomerController::class, 'show']);
            Route::get('/edit/{id}', [CustomerController::class, 'edit']);
            Route::post('/update/{id}', [CustomerController::class, 'update']);
        });

        Route::prefix('/payment')->group(function () {
            Route::get('/', [PaymentController::class, 'customerIndex'])->name('customer.payment.index');
            Route::get('/{id}/pay', [PaymentController::class, 'pay']);
            Route::get('/{id}', [PaymentController::class, 'show']);
        });


        Route::prefix('/ride')->group(function () {

            Route::get('/rating', [RatingController::class, 'customerIndex'])->name('customer.ride.rating.index');
            Route::get('{id}/rating', [RatingController::class, 'create']);
            Route::Post('/{id}/rating', [RatingController::class, 'store']);

            Route::get('/create', [CustomerRideController::class, 'create'])->name('customer.ride.create');
            Route::get('/', [CustomerRideController::class, 'index'])->name('customer.ride.index');
            Route::post('/', [CustomerRideController::class, 'store'])->name('customer.ride.store');
            Route::get('/{id}', [CustomerRideController::class, 'show'])->name('customer.ride.show');
            Route::get('/{id}/edit', [CustomerRideController::class, 'edit'])->name('customer.ride.edit');
            Route::post('/{id}', [CustomerRideController::class, 'update'])->name('customer.ride.update');
            Route::get('/{id}/cancel', [CustomerRideController::class, 'cancel'])->name('customer.ride.cancel');

        });
    });
});
