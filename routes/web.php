<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CabinTypeController;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\WardTypeController;
use App\Http\Controllers\IcuTypeController;

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
Route::get('cabintypes/deleteData/{id}',[CabinTypeController::class,'deleteData']);

Route::get('wardtypes/',[WardTypeController::class,'index']);
Route::post('wardtypes/saveData',[WardTypeController::class,'saveWardType']);
Route::get('wardtypes/editData/{id}',[WardTypeController::class,'getData']);
Route::get('wardtypes/deleteData/{id}',[WardTypeController::class,'deleteData']);

Route::get('icutypes/',[IcuTypeController::class,'index']);
Route::post('icutypes/saveData',[IcuTypeController::class,'saveIcuType']);
Route::get('icutypes/editData/{id}',[IcuTypeController::class,'getData']);
Route::get('icutypes/deleteData/{id}',[IcuTypeController::class,'deleteData']);

Route::get('cabins/',[CabinController::class,'index']);
Route::post('cabin/loadblocks', [CabinController::class, 'showBlocks']);
Route::post('cabin/saveData', [CabinController::class, 'saveCabin']);