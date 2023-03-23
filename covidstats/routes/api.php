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

// Updates database with current data from covid data summary api
Route::get('/fill_data', [CountryController::class, 'fill_data']);

// Update, add, and delete apis to control database in the project
Route::post('/update_country', [CountryController::class, 'update_country']);
Route::post('/add_country', [CountryController::class, 'add_country']);
Route::post('/delete_country', [CountryController::class, 'delete_country']);

// Get apis to get global and country data from project database
Route::get('get_global_data', [CountryController::class, 'get_global_data']);
Route::get('get_country_data', [CountryController::class, 'get_country_data']);
