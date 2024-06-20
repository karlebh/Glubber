<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TripController;

Route::post('/login', [LoginController::class, 'store']);
Route::post('/login/verify', [LoginController::class, 'verify']);


Route::group(['middleware' => 'auth:sanctum'], function () {

  Route::get('/driver', [DriverController::class, 'show']);
  Route::post('/driver/{driver}', [DriverController::class, 'store']);

  Route::post('/trip', [TripController::class, 'store']);
  Route::post('/trip/{trip}', [TripController::class, 'show']);
  Route::patch('/trip/{trip}/accept', [TripController::class, 'accept']);
  Route::patch('/trip/{trip}/start', [TripController::class, 'start']);
  Route::patch('/trip/{trip}/end', [TripController::class, 'end']);
  Route::patch('/trip/{trip}/location', [TripController::class, 'location']);

  Route::get('/user', function (Request $request) {
    return $request->user();
  });
});
