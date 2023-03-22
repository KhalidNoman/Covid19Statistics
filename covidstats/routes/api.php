<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\GlobalDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fill_data', [CountryController::class, 'fill_data']);
Route::post('/update_country', [CountryController::class, 'update_country']);
Route::post('/add_country', [CountryController::class, 'add_country']);
Route::post('/delete_country', [CountryController::class, 'delete_country']);


Route::get('get_global_data', [CountryController::class, 'get_global_data']);
Route::get('get_country_data', [CountryController::class, 'get_country_data']);
