<?php

use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Route;
use Buki\AutoRoute\AutoRouteFacade as Route;
use App\Http\Controllers\AksesRouteController;
use App\Http\Controllers\Admin\ArmadaController;

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

/* Route::macro('registerDynamicRoutes', function ($routes, $action) {
    if ($routes != null) {
        foreach ($routes as $route) {
            $uri = $route->Url;
            $actions = $action["$route->KodeFitur"];

            if ($route->KodeFitur == 0) {
                Route::get("/$uri", $actions);
            } else {
                Route::view("/$uri", "$actions");
            }
        }
    }
}); */

function getUserRoute()
{
    return (new AksesRouteController)->getRoute();
}

Route::get('test', function () {
    return view('welcome');
});

## auth
Route::get('login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\Auth\LoginController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('akses', [App\Http\Controllers\AksesController::class, 'index'])->name('akses');
    Route::get('ubah-password', [App\Http\Controllers\ProfileController::class, 'ubah_password'])->name('profile.ubah-password');
    Route::post('simpan_password', [App\Http\Controllers\ProfileController::class, 'simpan_password'])->name('simpan_password');

    $routes = getUserRoute();
    foreach ($routes as $row) {
        $method = explode("|", $row->Method);
        if($row->Url != ''){
            foreach ($method as $met) {
                Route::$met($row->Slug, "$row->Url");
            }
        }
    }
});
