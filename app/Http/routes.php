<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin', function () {
    return view('admin.index');
});


Route::resource('admin/users', 'AdminUsersController');
// GET|HEAD  | admin/users              | admin.users.index   | App\Http\Controllers\AdminUsersController@index                 | web        |
// POST      | admin/users              | admin.users.store   | App\Http\Controllers\AdminUsersController@store                 | web        |
// GET|HEAD  | admin/users/create       | admin.users.create  | App\Http\Controllers\AdminUsersController@create                | web        |
// PUT|PATCH | admin/users/{users}      | admin.users.update  | App\Http\Controllers\AdminUsersController@update                | web        |
// GET|HEAD  | admin/users/{users}      | admin.users.show    | App\Http\Controllers\AdminUsersController@show                  | web        |
// DELETE    | admin/users/{users}      | admin.users.destroy | App\Http\Controllers\AdminUsersController@destroy               | web        |
// GET|HEAD  | admin/users/{users}/edit | admin.users.edit    | App\Http\Controllers\AdminUsersController@edit                  | web        |



// - PHPMyPersonalAdmin (MyPeA) ---------------------------------------------------------------------------
// composer require bgaze/bootstrap-form
Route::get('mypea/{table?}','MypeaController@index');
Route::get('mypea/{table?}/new','MypeaController@new');
Route::post('mypea/insert','MypeaController@insert');
Route::get('mypea/{table}/{id}/edit','MypeaController@edit');
Route::put('mypea/update', 'MypeaController@update');
Route::get('mypea/{table}/{id}/delete', 'MypeaController@delete');
