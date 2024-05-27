<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CabinTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/masterlayout', function () {
    return view('masterlayout.masterlayout');
});

Route::get('floors/',[FloorController::class,'index']);
Route::post('floors/saveData',[FloorController::class,'saveFloor']);
Route::get('floors/editData/{id}',[FloorController::class,'getData']);
Route::get('floors/deleteData/{id}',[FloorController::class,'deleteData']);

Route::get('blocks/',[BlockController::class,'index']);
Route::post('blocks/saveData',[BlockController::class,'saveBlock']);
Route::get('blocks/editData/{id}',[BlockController::class,'getData']);
Route::get('blocks/deleteData/{id}',[BlockController::class,'deleteData']);

Route::get('amenities/',[AmenityController::class,'index']);
Route::post('amenities/saveData',[AmenityController::class,'saveAmenity']);
Route::get('amenities/editData/{id}',[AmenityController::class,'getData']);
Route::get('amenities/deleteData/{id}',[AmenityController::class,'deleteData']);

Route::get('cabintypes/',[CabinTypeController::class,'index']);
Route::post('cabintypes/saveData',[CabinTypeController::class,'saveCabinType']);
Route::get('cabintypes/editData/{id}',[CabinTypeController::class,'getData']);
Route::get('amenities/deleteData/{id}',[CabinTypeController::class,'deleteData']);