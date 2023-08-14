<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

Route::post('login', 'UserController@authenticate');
Route::post('recover', 'UserController@recover');
Route::post('users/init', 'UserController@init');
Route::post('users/enter', 'UserController@enter');
Route::group(['middleware' => 'jwt.auth'], function () {

    Route::get('country/list', 'CountryController@list');

    Route::post('location/list', 'LocationController@list');

    Route::post('state/list', 'StateController@list');

    Route::get('details/detail/{type}', 'DetailController@detail');

    Route::get('demographics/detail/{user_id?}', 'DemographicController@detail');
    Route::post('demographics/store', 'DemographicController@store');

    Route::get('unity/detail/{user_id?}', 'UnityController@detail');
    Route::post('unity/store', 'UnityController@store');

    Route::get('pittsburgh/detail/{user_id?}', 'PittsburghController@detail');
    Route::post('pittsburgh/store', 'PittsburghController@store');

    Route::get('cicardian/detail/{user_id?}', 'CicardianController@detail');
    Route::post('cicardian/store', 'CicardianController@store');

    Route::get('affection/detail/{user_id?}', 'AffectionController@detail');
    Route::post('affection/store', 'AffectionController@store');

    Route::get('violence/detail/{user_id?}', 'ViolenceController@detail');
    Route::post('violence/store', 'ViolenceController@store');

    Route::get('family/list', 'FamilyController@list');
    Route::post('family/store', 'FamilyController@store');
    Route::post('family/remove', 'FamilyController@remove');

    Route::get('messages/list', 'MessageController@list');
    Route::post('users/report', 'UserController@report');

    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/
    Route::get('users/list', 'UserController@list');
    Route::post('users/find', 'UserController@find');
    Route::post('users/detail', 'UserController@detail');
    Route::post('users/store', 'UserController@store');
    Route::post('users/enabled', 'UserController@enabled');
    Route::post('users/confirmconsent', 'UserController@confirmconsent');

    Route::get('valid', 'UserController@valid');
    Route::get('logout', 'UserController@logout');
});