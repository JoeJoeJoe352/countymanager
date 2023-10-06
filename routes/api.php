<?php

use App\Http\Controllers\CityController;
use App\Http\Resources\CityCollection;
use App\Models\City;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request)
//{
//    return $request->user();
//});
//
//Route::middleware('auth:api')->get('/user', function (Request $request)
//{
//    return $request->user();
//});
//
//Route::group(['middleware' => ['auth:api']], function ()
//{


Route::get('/varosok-listazasa', function (Request $request)
{
    return new CityCollection(City::all());
});

Route::post('/uj-varos', [CityController::class, "saveCity"]);
Route::put('/varos-modositas/{id}', [CityController::class, "updateCity"])->where('id', '[0-9]+');
Route::delete('/varos-torlese/{id}', [CityController::class, "deleteCity"])->where('id', '[0-9]+');
