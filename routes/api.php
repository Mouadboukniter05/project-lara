<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::POST('fsfsfs', 'APISaveController@SaveMessage');
Route::POST('login', 'APILoginController@Login');
/////////////////////////////////////////////
Route::GET('clients', 'API\ClientController@index');
Route::GET('projets/{id}', 'API\ClientController@indexall');
Route::GET('clients/{id}', 'API\ClientController@hesAfterUpdate');
Route::PUT('clients/update/{id}', 'API\ClientController@updateInfoClient');
///////////////////////////////////////////////////////
Route::GET('messages/{id}', 'API\LetterController@showMessages');
Route::POST('messages/sendmessage', 'API\LetterController@sendMessage');
//Route::GET('messages', 'API\MessageController@index');
//lalok@gmail.com
//0708060410