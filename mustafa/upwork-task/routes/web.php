<?php

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

Route::get('/', function () {
   return view('welcome');
});


//Route::get('/','App\Http\Controllers\Home@index');


//Route::get('/ads', 'App\Http\Controllers\Ads@Index');
// front ..

//$realpath = realpath("./");
//$realpath2  = str_replace("public", "", $realpath );



// $filesInFolder = \File::files('app/Http/Controllers/front');

// foreach ($filesInFolder as $path) {
//     $file = pathinfo($path);
//     $controllers_name = $file['filename'];
//     $controllers_url = strtolower($file['filename']);

//     $class = "App\Http\Controllers\\front\\$controllers_name";
//     $reflect = new \ReflectionClass($class);
//     $properties = $reflect->getMethods(\ReflectionMethod::IS_PUBLIC);

//     foreach ($properties as $item):
//         if ($item->class == $class):
//             if ($item->name == "index") {
//                 if ($controllers_name == "Home") {
//                     Route::any('/' , "App\Http\Controllers\\front\\$controllers_name@Index");
//                 } else {
//                     Route::any('/' . $controllers_url, "App\Http\Controllers\\front\\$controllers_name@Index");
//                 }
//             } else {
//                 Route::any('/' . $controllers_url . "/$item->name/{uri_1?}/{uri_2?}/{uri_3?}/{uri_4?}/{uri_5?}", "App\Http\Controllers\\front\\$controllers_name@$item->name");
//             }
//         endif;
//     endforeach;
// }




// admin ..
$filesInFolder = \File::files('app/Http/Controllers/admin/');
foreach ($filesInFolder as $path) {
    $file = pathinfo($path);
    $controllers_name = $file['filename'];
    $controllers_url = strtolower($file['filename']);
    $class = "App\Http\Controllers\admin\\$controllers_name";
    $reflect = new \ReflectionClass($class);
    $properties = $reflect->getMethods(\ReflectionMethod::IS_PUBLIC);
    foreach ($properties as $item):
        if ($item->class == $class):
            if ($item->name == "index") {
                if ($controllers_name == "Home") {
                    Route::any('/rc-admin', "App\Http\Controllers\admin\\$controllers_name@Index");
                } else {
                    Route::any('/rc-admin/' . $controllers_url, "App\Http\Controllers\admin\\$controllers_name@Index");
                }
            } else {
                Route::any('/rc-admin/' . $controllers_url . "/$item->name/{uri_1?}/{uri_2?}/{uri_3?}/{uri_4?}/{uri_5?}", "App\Http\Controllers\admin\\$controllers_name@$item->name");
            }
        endif;
    endforeach;
} 


// settings ..
$filesInFolder = \File::files('app/Http/Controllers/admin/settings');
foreach ($filesInFolder as $path) {
    $file = pathinfo($path);
    $controllers_name = $file['filename'];
    $controllers_url = strtolower($file['filename']);
    $class = "App\Http\Controllers\admin\settings\\$controllers_name";
    $reflect = new \ReflectionClass($class);
    $properties = $reflect->getMethods(\ReflectionMethod::IS_PUBLIC);
    foreach ($properties as $item):
        if ($item->class == $class):
            if ($item->name == "index") {
                if ($controllers_name == "Home") {
                    Route::any('/rc-admin/settings', "App\Http\Controllers\admin\settings\\$controllers_name@Index");
                } else {
                    Route::any('/rc-admin/settings/' . $controllers_url, "App\Http\Controllers\admin\settings\\$controllers_name@Index");
                }
            } else {
                Route::any('/rc-admin/settings/' . $controllers_url . "/$item->name/{uri_1?}/{uri_2?}/{uri_3?}/{uri_4?}/{uri_5?}", "App\Http\Controllers\admin\settings\\$controllers_name@$item->name");
            }
        endif;
    endforeach;
} 