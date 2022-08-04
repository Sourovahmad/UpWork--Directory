<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ensureUserisSuperadmin;
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


Route::middleware(['auth:sanctum'])->group(function () {


    // User Routes

    Route::get('/', [indexController::class, 'index'])->name('home');
    Route::get('filter',[indexController::class,'filter'])->name('filterData');


    // Admin Routes
    Route::middleware(ensureUserisSuperadmin::class)->group(function () {

        Route::get('/admin',[UserController::class, 'index'])->name('admin_home');
        Route::post('import_csv', [UserController::class, 'store'])->name('import_csv');
        Route::post('delete_user', [UserController::class, 'destroy'])->name('delete_user');

    });


    
});
