<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CabinTypeController;
use App\Http\Controllers\WardTypeController;
use App\Http\Controllers\IcuTypeController;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\IcuController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\BedCategoryController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BedAssignController;


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

Route::get('/masters', function () {
    return view('backend.master');
});

Route::get('floors/',[FloorController::class,'index']);
Route::post('floors/saveData',[FloorController::class,'saveFloor']);
Route::get('floors/editData/{count}',[FloorController::class,'getData']);
Route::get('floors/deleteData/{id}/{count}',[FloorController::class,'deleteData']);

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
Route::get('cabin/editData/{id}',[CabinController::class,'getData']);
Route::get('cabins/deleteData/{id}',[CabinController::class,'deleteData']);

Route::get('wards/',[WardController::class,'index']);
Route::post('ward/loadblocks', [WardController::class, 'showBlocks']);
Route::post('ward/saveData', [WardController::class, 'saveWard']);
Route::get('ward/editData/{id}',[WardController::class,'getData']);
Route::get('wards/deleteData/{id}',[WardController::class,'deleteData']);

Route::get('icus/',[IcuController::class,'index']);
Route::post('icu/loadblocks', [IcuController::class, 'showBlocks']);
Route::post('icu/saveData', [IcuController::class, 'saveIcu']);
Route::get('icu/editData/{id}',[IcuController::class,'getData']);
Route::get('icu/deleteData/{id}',[IcuController::class,'deleteData']);

Route::get('bedtypes/',[BedTypeController::class,'index']);
Route::post('bedtypes/saveData', [BedTypeController::class, 'saveBedtype']);
Route::get('bedtypes/editData/{id}',[BedTypeController::class,'getData']);
Route::get('bedtypes/deleteData/{id}',[BedTypeController::class,'deleteData']);

Route::get('bedcategories/',[BedCategoryController::class,'index']);
Route::post('bedcategories/saveData', [BedCategoryController::class, 'saveBedCateggory']);
Route::get('bedcategories/editData/{id}',[BedCategoryController::class,'getData']);
Route::get('bedcategories/deleteData/{id}',[BedCategoryController::class,'deleteData']);

Route::get('beds/',[BedController::class,'index']);
Route::post('beds/loadblocks', [CabinController::class, 'showBlocks']);
Route::post('beds/saveData',[BedController::class,'saveBed']);
Route::get('beds/editData/{id}',[BedController::class,'getData']);
Route::get('beds/deleteData/{id}',[BedController::class,'deleteData']);

Route::get('bedassignvisual/',[BedAssignController::class,'newIndex']);
Route::post('bedform/getalldata',[BedAssignController::class,'getDataval']);
Route::post('bedassign/assign',[BedAssignController::class,'assignBed']);
