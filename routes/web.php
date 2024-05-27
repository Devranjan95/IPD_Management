<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\BlockController;
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