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
    return redirect('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.home');

Route::get('/resetpassword', 'ResetpasswordController@index');
Route::put('/resetpassword/save', 'ResetpasswordController@store');

Route::get('/audit-trail', 'AudittrailController@index');
Route::get('/audit-trail/data', 'AudittrailController@data');

Route::get('/what-wrong', 'WhatwrongController@index');
Route::get('/what-wrong/datapap', 'WhatwrongController@datapap');
Route::get('/what-wrong/datavlan', 'WhatwrongController@datavlan');

Route::get('/user-online', 'UseronlineController@index');
Route::get('/user-online/data', 'UseronlineController@data');

Route::get('/user-online/test', 'UseronlineController@show');

});

//Route for admin
Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => ['admin']], function(){
        Route::get('/wifi-function', 'Admin\WifiFunctionController@index');
        Route::get('/wifi-function/data', 'Admin\WifiFunctionController@data');

        Route::get('/wifi-function/{id}/edit', 'Admin\WifiFunctionController@getEdit');
        Route::post('/wifi-function/{id}/edit', 'Admin\WifiFunctionController@userEdit');

        Route::get('/wifi-function/{id}/delete', 'Admin\WifiFunctionController@destroy');

        Route::get('/wifi-function/reorder', 'Admin\WifiFunctionController@getReorder');
        
        Route::get('/wifi-function/create', 'Admin\WifiFunctionController@getCreate');
        Route::post('/wifi-function/create', 'Admin\WifiFunctionController@userCreate');
///////////////////////////////////////////////////////////////////////////////////////////////

        Route::get('/users', 'Admin\UsermanagerController@index');
        Route::get('/users/data', 'Admin\UsermanagerController@Data');

        Route::get('/users/{id}/edit', 'Admin\UsermanagerController@getEdit');
        Route::post('/users/{id}/edit', 'Admin\UsermanagerController@userEdit');

        Route::get('/users/create', 'Admin\UsermanagerController@getCreate');
        Route::post('/users/create', 'Admin\UsermanagerController@userCreate');


///////////////////////////////////////////////////////////////////////////////////////////////        
        Route::get('/group-config', 'Admin\GroupController@index');
        Route::get('/group-config/data', 'Admin\GroupController@data');

///////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/mac-auth', 'Admin\MacauthController@index');
        Route::get('/mac-auth/data', 'Admin\MacauthController@data');

        Route::get('/mac-auth/create', 'Admin\MacauthController@getCreate');
        Route::post('/mac-auth/create', 'Admin\MacauthController@macCreate');

        Route::get('/mac-auth/{id}/edit', 'Admin\MacauthController@getEdit');
        Route::post('/mac-auth/{id}/edit', 'Admin\MacauthController@saveEdit');

        Route::get('/mac-auth/{id}/delete', 'Admin\MacauthController@destroy');
        
//////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/guest-config', 'Admin\GuestController@index');
        Route::get('/guest-config/data', 'Admin\GuestController@data');
    });
});


//Route::resource('audit-trail', 'AudittrailController');