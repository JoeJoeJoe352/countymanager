<?php

use App\Http\Controllers\CityController;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CountyCollection;
use App\Models\City;
use App\Models\County;
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

Route::get('/varosok-listazasa/{countyId}', function (Request $request, int $countyId)
{
    return new CityCollection(City::where(["county_id"=>$countyId])->get());
});
Route::get('/megyek-listazasa', function (Request $request)
{
    return new CountyCollection(County::all());
});

Route::post('/uj-varos', [CityController::class, "saveCity"]);
Route::put('/varos-modositas/{id}', [CityController::class, "updateCity"])->where('id', '[0-9]+');
Route::delete('/varos-torlese/{id}', [CityController::class, "deleteCity"])->where('id', '[0-9]+');
