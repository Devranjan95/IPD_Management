<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CabinTypeController;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\WardTypeController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\IcuTypeController;
use App\Http\Controllers\IcuController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BedCategoryController;
// use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\BedAssignController;
use App\Http\Controllers\IDproofController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\DischargeController;
use App\Http\Controllers\DeathController;
use App\Http\Controllers\BirthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('backend.Dashboard.dashboard');
// })->middleware(['auth', 'verified','role.new'])->name('dashboard');
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified','role.new'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/edit.profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/update.profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/destroy.profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


// *******************************************************************************************
    Route::middleware(['role.new'])->group(function () {
        // Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('registration/',[RegistrationController::class,'index'])->middleware('check.permission:2');
        Route::get('idprooflength/{idproofID}',[RegistrationController::class,'getidproofLength'])->middleware('check.permission:2');
        Route::get('getbedinfo/{bednum}',[RegistrationController::class,'getBedData'])->middleware('check.permission:2');
        Route::get('getpatient/data/{patid}',[RegistrationController::class,'searchPatient'])->middleware('check.permission:2');
        Route::post('registration/saveData',[RegistrationController::class,'saveRegistration'])->middleware('check.permission:2');
        Route::get('getregn/printpass/{regn}', [RegistrationController::class, 'getPatient'])->middleware('check.permission:2');
        Route::post('getamenitycost', [RegistrationController::class, 'getAmenityCost'])->middleware('check.permission:2');

        Route::get('/masterlayout', function () {
            return view('masterlayout.masterlayout');
        });
        
        Route::get('/masters', function () {
            return view('backend.MasterStructure.master');
        })->middleware('check.permission:4');

        Route::get('/visitorpass', function () {
            return view('backend.visitorpass');
        })->middleware('check.permission:2');

        Route::get('floors/',[FloorController::class,'index'])->middleware('check.permission:4');
        Route::post('floors/saveData',[FloorController::class,'saveFloor'])->middleware('check.permission:4');
        Route::get('floors/editData/{id}',[FloorController::class,'getData'])->middleware('check.permission:4');
        Route::get('floors/deleteData/{id}/{count}',[FloorController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('blocks/',[BlockController::class,'index'])->middleware('check.permission:4');
        Route::post('blocks/saveData',[BlockController::class,'saveBlock'])->middleware('check.permission:4');
        Route::get('blocks/editData/{id}',[BlockController::class,'getData'])->middleware('check.permission:4');
        Route::get('blocks/deleteData/{id}',[BlockController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('amenities/',[AmenityController::class,'index'])->middleware('check.permission:4');
        Route::post('amenities/saveData',[AmenityController::class,'saveAmenity'])->middleware('check.permission:4');
        Route::get('amenities/editData/{id}',[AmenityController::class,'getData'])->middleware('check.permission:4');
        Route::get('amenities/deleteData/{id}',[AmenityController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('idproof/',[IDproofController::class,'index'])->middleware('check.permission:4');
        Route::post('idproof/saveData',[IDproofController::class,'saveIDproof'])->middleware('check.permission:4');
        Route::get('idproof/editData/{id}',[IDproofController::class,'getIdproof'])->middleware('check.permission:4');
        Route::get('idproof/deleteData/{id}',[IDproofController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('cabintypes/',[CabinTypeController::class,'index'])->middleware('check.permission:4');
        Route::post('cabintypes/saveData',[CabinTypeController::class,'saveCabinType'])->middleware('check.permission:4');
        Route::get('cabintypes/editData/{id}',[CabinTypeController::class,'getData'])->middleware('check.permission:4');
        Route::get('cabintypes/deleteData/{id}',[CabinTypeController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('wardtypes/',[WardTypeController::class,'index'])->middleware('check.permission:4');
        Route::post('wardtypes/saveData',[WardTypeController::class,'saveWardType'])->middleware('check.permission:4');
        Route::get('wardtypes/editData/{id}',[WardTypeController::class,'getData'])->middleware('check.permission:4');
        Route::get('wardtypes/deleteData/{id}',[WardTypeController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('icutypes/',[IcuTypeController::class,'index'])->middleware('check.permission:4');
        Route::post('icutypes/saveData',[IcuTypeController::class,'saveIcuType'])->middleware('check.permission:4');
        Route::get('icutypes/editData/{id}',[IcuTypeController::class,'getData'])->middleware('check.permission:4');
        Route::get('icutypes/deleteData/{id}',[IcuTypeController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('cabins/',[CabinController::class,'index'])->middleware('check.permission:4');
        Route::post('cabin/loadblocks', [CabinController::class, 'showBlocks'])->middleware('check.permission:4');
        Route::post('cabin/saveData', [CabinController::class, 'saveCabin'])->middleware('check.permission:4');
        Route::get('cabin/editData/{id}',[CabinController::class,'getData'])->middleware('check.permission:4');
        Route::get('cabins/deleteData/{id}',[CabinController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('wards/',[WardController::class,'index'])->middleware('check.permission:4');
        Route::post('ward/loadblocks', [WardController::class, 'showBlocks'])->middleware('check.permission:4');
        Route::post('ward/saveData', [WardController::class, 'saveWard'])->middleware('check.permission:4');
        Route::get('ward/editData/{id}',[WardController::class,'getData'])->middleware('check.permission:4');
        Route::get('wards/deleteData/{id}',[WardController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('icus/',[IcuController::class,'index'])->middleware('check.permission:4');
        Route::post('icu/loadblocks', [IcuController::class, 'showBlocks'])->middleware('check.permission:4');
        Route::post('icu/saveData', [IcuController::class, 'saveIcu'])->middleware('check.permission:4');
        Route::get('icu/editData/{id}',[IcuController::class,'getData'])->middleware('check.permission:4');
        Route::get('icu/deleteData/{id}',[IcuController::class,'deleteData'])->middleware('check.permission:4');

        // Route::get('bedtypes/',[BedTypeController::class,'index']);
        // Route::post('bedtypes/saveData', [BedTypeController::class, 'saveBedtype']);
        // Route::get('bedtypes/editData/{id}',[BedTypeController::class,'getData']);
        // Route::get('bedtypes/deleteData/{id}',[BedTypeController::class,'deleteData']);

        Route::get('bedcategories/',[BedCategoryController::class,'index'])->middleware('check.permission:4');
        Route::post('bedcategories/saveData', [BedCategoryController::class, 'saveBedCateggory'])->middleware('check.permission:4');
        Route::get('bedcategories/editData/{id}',[BedCategoryController::class,'getData'])->middleware('check.permission:4');
        Route::get('bedcategories/deleteData/{id}',[BedCategoryController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('beds/',[BedController::class,'index'])->middleware('check.permission:4');
        Route::post('beds/loadblocks', [CabinController::class, 'showBlocks'])->middleware('check.permission:4');
        Route::post('beds/saveData',[BedController::class,'saveBed'])->middleware('check.permission:4');
        Route::get('beds/editData/{id}',[BedController::class,'getData'])->middleware('check.permission:4');
        Route::get('beds/deleteData/{id}',[BedController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('bedassignvisual/',[BedAssignController::class,'newIndex'])->middleware('check.permission:4');
        //Route::post('bedform/getalldata',[BedAssignController::class,'getDataval']);
        Route::get('bedform/getalldata/{id}/{flag}',[BedAssignController::class,'getDataval'])->middleware('check.permission:4');
        Route::post('bedassign/assign',[BedAssignController::class,'assignBed'])->middleware('check.permission:4');
        Route::get('editassignbed/{id}/{type}',[BedAssignController::class,'getDataValues'])->middleware('check.permission:4');
        Route::post('bednumber/delete',[BedAssignController::class,'removeBed'])->middleware('check.permission:4');

        Route::get('roles/',[RoleController::class,'index'])->middleware('check.permission:4');
        Route::post('role/saveData',[RoleController::class,'saveRole'])->middleware('check.permission:4');
        Route::get('role/editData/{id}',[RoleController::class,'getData'])->middleware('check.permission:4');
        Route::get('role/deleteData/{id}',[RoleController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('permissions/',[PermissionController::class,'index'])->middleware('check.permission:4');
        Route::post('permission/saveData',[PermissionController::class,'savePermission'])->middleware('check.permission:4');
        Route::get('permission/editData/{id}',[PermissionController::class,'getData'])->middleware('check.permission:4');
        Route::get('permission/deleteData/{id}',[PermissionController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('actions/',[ActionController::class,'index'])->middleware('check.permission:4');
        Route::post('action/saveData',[ActionController::class,'saveAction'])->middleware('check.permission:4');
        Route::get('action/editData/{id}',[ActionController::class,'getData'])->middleware('check.permission:4');
        Route::get('action/deleteData/{id}',[ActionController::class,'deleteData'])->middleware('check.permission:4');

        Route::get('patientstatusupdate/',[StatusController::class,'index'])->middleware('check.permission:5');
        Route::post('searchPatient/status',[StatusController::class,'searchPatient'])->middleware('check.permission:5');
        Route::post('updateTokenStatus',[StatusController::class,'updateStatus'])->middleware('check.permission:5');
        Route::post('updateStatusBorn',[StatusController::class,'updateStatusNewBorn'])->middleware('check.permission:5');
        Route::post('updateStatusdischargeprocess',[StatusController::class,'updateStatusNewDischargeProcess'])->middleware('check.permission:5');

        Route::get('discharge/',[DischargeController::class,'index'])->middleware('check.permission:6');
        Route::post('discharge/searchPatient',[DischargeController::class,'searchPatient'])->middleware('check.permission:6');
        Route::post('discharge/saveData',[DischargeController::class,'saveDischarge'])->middleware('check.permission:6');
        Route::get('finaldischarge',[DischargeController::class,'finalDischarge'])->middleware('check.permission:7');
        Route::post('searchPatient/dischargeInprogress',[DischargeController::class,'searchDischargeInprogress'])->middleware('check.permission:6');
        Route::post('updateFinalDischarge',[DischargeController::class,'updateDischarge'])->middleware('check.permission:6');

        Route::get('deathentry/',[DeathController::class,'index'])->middleware('check.permission:8');
        Route::post('deathrecord/searchPatient',[DeathController::class,'searchPatient'])->middleware('check.permission:8');
        Route::post('deathrecord/saveData',[DeathController::class,'saveDeathRecord'])->middleware('check.permission:8');


        Route::get('birthentry/',[BirthController::class,'index'])->middleware('check.permission:9');
        Route::post('birthrecord/searchPatient',[BirthController::class,'searchPatient'])->middleware('check.permission:9');
        Route::post('birthrecord/saveData',[BirthController::class,'saveBirthRecord'])->middleware('check.permission:9');

        Route::get('birthreports/',[ReportController::class,'index'])->middleware('check.permission:12');
        Route::get('deathreports/',[ReportController::class,'index_death'])->middleware('check.permission:11');
        Route::get('patientreports/',[ReportController::class,'index_patient'])->middleware('check.permission:10');
        Route::get('dischargereports/',[ReportController::class,'index_discharge'])->middleware('check.permission:14');
        Route::get('bedreports/',[ReportController::class,'index_bed'])->middleware('check.permission:13');

        //Route::get('')
        
    });
    
// *******************************************************************************************
});

require __DIR__.'/auth.php';
