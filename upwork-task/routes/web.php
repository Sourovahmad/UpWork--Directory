<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\RoadmapController;

use App\Http\Controllers\TodoController;
use App\Http\Livewire\Roadmaps;
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

    Route::get('/', [RoadmapController::class, 'index'])->name('home');
   


});
