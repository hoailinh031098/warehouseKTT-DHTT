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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
//============Auth Router ====================//
Route::get('/login','Auth\AuthController@indexlogin')->name('login');
Route::post('/actionlogin', 'Auth\AuthController@login')->name('actionlogin');
Route::get('/', 'Auth\AuthController@authenticate')->name('home');
Route::post('/logout','Auth\AuthController@logout')->name('logout');


//============Admin_Router=============//
Route::group(['prefix'=>'/admin','middleware'=>'checkRoleAdmin'],function(){
    Route::get('/homepage','Admin\userController@index')->name('homepage');
    Route::group(['prefix'=>'/user'],function(){
        Route::get('/create','Admin\userController@index_userCreate');
        Route::post('/user_create','Admin\userController@action_userCreate')->name('user_create');
        Route::put('/user_edit','Admin\userController@edit_user')->name('user_edit');
        Route::put('/reset_password','Admin\userController@reset_password')->name('reset_password');
        Route::get('/manager','Admin\userController@index_userManager');
    });
    Route::group(['prefix'=>'/device'],function(){
        Route::get('/managerDeviceGroup','Admin\deviceController@indexManagerDeviceGroup')->name('managerDeviceGroup');
        Route::get('/getManagerDeviceGroup','Admin\deviceController@getManagerDeviceGroup')->name('getManagerDeviceGroup');
        Route::get('/findDeviceGroup','Admin\deviceController@findDeviceGroup')->name('findDeviceGroup');
        Route::post('/createDeviceGroup','Admin\deviceController@createDeviceGroup')->name('createDeviceGroup');
        Route::put('/editDeviceGroup','Admin\deviceController@editDeviceGroup')->name('editDeviceGroup');
        Route::delete('/deleteDeviceGroup','Admin\deviceController@deleteDeviceGroup')->name('deleteDeviceGroup');

        Route::get('/managerDevice','Admin\deviceController@indexManagerDevice')->name('managerDevice');
        Route::get('/getManagerDevice','Admin\deviceController@getManagerDevice')->name('getManagerDevice');
        Route::get('/findDevice','Admin\deviceController@findDevice')->name('findDevice');
        Route::post('/createDevice','Admin\deviceController@createDevice')->name('createDevice');
        Route::put('/editDevice','Admin\deviceController@editDevice')->name('editDevice');
        Route::delete('/deleteDevice','Admin\deviceController@deleteDevice')->name('deleteDevice');

        Route::get('/managerDeviceLine','Admin\deviceController@indexManagerDeviceLine')->name('managerDeviceLine');
        Route::get('/getManagerDeviceLine','Admin\deviceController@getManagerDeviceLine')->name('getManagerDeviceLine');
        Route::get('/findDeviceByDG','Admin\deviceController@findDeviceByDG')->name('findDeviceByDG');
        Route::get('/findDeviceLine','Admin\deviceController@findDeviceLine')->name('findDeviceLine');
        Route::post('/createDeviceLine','Admin\deviceController@createDeviceLine')->name('createDeviceLine');
        Route::put('/editDeviceLine','Admin\deviceController@editDeviceLine')->name('editDeviceLine');
        Route::delete('/deleteDeviceLine','Admin\deviceController@deleteDeviceLine')->name('deleteDeviceLine');
    });
    Route::group(['prefix'=>'/warehouse'],function(){
        Route::get('/managerWarehouse','Admin\warehouseController@indexManagerWarehouse')->name('managerWarehouse');
        Route::get('/getManagerWarehouse','Admin\warehouseController@getManagerWarehouse')->name('getManagerWarehouse');
        Route::get('/findWarehouse','Admin\warehouseController@findWarehouse')->name('findWarehouse');
        Route::post('/createWarehouse','Admin\warehouseController@createWarehouse')->name('createWarehouse');
        Route::put('/editWarehouse','Admin\warehouseController@editWarehouse')->name('editWarehouse');
        Route::delete('/deleteWarehouse','Admin\warehouseController@deleteWarehouse')->name('deleteWarehouse');
    });
    Route::group(['prefix'=>'/telecommunication'],function(){
        Route::get('/managerTelecommunicationCenter','Admin\telecommunicationController@indexManagerTelecommunicationCenter')->name('managerTelecommunicationCenter');
        Route::get('/getManagerTelecommunicationCenter','Admin\telecommunicationController@getManagerTelecommunicationCenter')->name('getManagerTelecommunicationCenter');
    });
});
//========================================================================================================
//============User-DHTT_Router===============//
Route::group(['prefix'=>'/UserDHTT','middleware'=>'checkRoleUserDHTT'],function(){
    Route::get('/homepage','UserDHTT\userDHTTController@index')->name('homepage');
    
});
