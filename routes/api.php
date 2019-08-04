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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('expression', 'Expression\ExpressionController@expression');
Route::get('expression/{id}', 'Expression\ExpressionController@expressionByID');
Route::post('expression', 'Expression\ExpressionController@expressionSave')->middleware('xml');
Route::put('expression/{id}', 'Expression\ExpressionController@expressionUpdate')->middleware('xml');
Route::delete('expression/{id}', 'Expression\ExpressionController@expressionDelete');
