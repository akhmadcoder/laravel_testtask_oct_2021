<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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


Route::apiResource('client', ClientController::class);
// list data 
Route::post('/client/index',[ClientController::class,'index']);

// create new data 
Route::post('/client/store',[ClientController::class,'store']);

// update data 
Route::post('/client/{client}/update',[ClientController::class,'update']);

// show specific data by id
Route::get('/client/{client}',[ClientController::class,'show']);

// delete data 
Route::post('/client/{client}/destroy',[ClientController::class,'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


	
