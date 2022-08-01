
<?php

use App\Models\faq;
use App\Models\roadmap;
use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('roadmaps', function ()
{
   return roadmap::with('items')->get();
});


Route::get('faqs', function () {
    return faq::all();
});

Route::get('todos', function () {
    return todo::all();
});