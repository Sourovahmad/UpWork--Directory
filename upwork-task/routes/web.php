<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ensureUserisSuperadmin;
use App\Http\Middleware\ensureWebsiteActive;
use Illuminate\Support\Facades\Route;

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

// Route::post('/register', function () {
//     return view('auth.register');
// })->name('register');




Route::post('login_post', [indexController::class,'login'])->name('login_post');



Route::middleware(['auth:sanctum'])->group(function () {

    // User Routes


    // Route::middleware(ensureWebsiteActive::class)->group(function () {

        Route::get('/', [indexController::class, 'index'])->name('home');
        Route::get('filter',[indexController::class,'filter'])->name('filterData');
        Route::get('filterName',[indexController::class,'filter_name'])->name('filterName');

    // });


    // Admin Routes
    Route::middleware(ensureUserisSuperadmin::class)->group(function () {

        Route::get('/admin',[UserController::class, 'index'])->name('admin_home');
        Route::post('import_csv', [UserController::class, 'store'])->name('import_csv');
        Route::post('import_image', [UserController::class, 'import_image'])->name('import_image');
        Route::post('delete_user', [UserController::class, 'destroy'])->name('delete_user');
        Route::post('change_status',[UserController::class,'change_status'])->name('change_status');

    });

    
});

