<?php

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
    //return view('app', ['module'=>'home']);
    return view('home');
});

// Route::get('/{module}', function ($module) {
//     return view('app', ['module' => $module]);
// });

Route::resource('tower', 'TowerController');
Route::resource('floor', 'FloorController');
Route::resource('owner_unit', 'OwnerUnitController');
Route::resource('tenant', 'TenantController');
Route::resource('complain', 'ComplainController');

Route::get('tower/{id}/delete', 'TowerController@deleteTemplate');
Route::get('floor/{id}/delete', 'FloorController@deleteTemplate');
Route::get('owner_unit/{id}/delete', 'OwnerUnitController@deleteTemplate');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('login', 'Auth\LoginController@authenticate')->name('authenticate');
//Route::get('/home', function () {
    // Only authenticated users may enter...
//})->middleware('auth');
Route::get('/logout', 'LoginController@Logout')->name('logout');