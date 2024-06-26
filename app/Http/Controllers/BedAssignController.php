<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;
use App\Models\Bed;
use App\Models\WardType;
use App\Models\CabinType;
use App\Models\IcuType;
use App\Models\BedAssign;


class BedAssignController extends Controller
{

    public function newIndex(){
        $floors = Floor::all();
        $cabindetails = [];
        $warddetails = [];
        $icudetails = [];
        $beds = Bed::where('status','Active')->get();
        foreach ($floors as $floor) {
            $cabins = Cabin::where('floor_count', $floor->count) 
                            ->select('id','cabin_name', 'total_occupancy', 'assigned','status')
                            ->get();
            $wards = Ward::where('floor_count', $floor->count) 
                            ->select('id','ward_name', 'total_occupancy', 'assigned','status')
                            ->get(); 
            $icus = Icu::where('floor_count', $floor->count) 
                            ->select('id','icu_name', 'total_occupancy', 'assigned','status')
                            ->get();                 
            $cabindetails[$floor->count] = $cabins;
            $warddetails[$floor->count] = $wards;
            $icudetails[$floor->count] = $icus;
        }
    
        return view('backend.bedassignvisual', [
            'floors' => $floors,
            'cabindetails' => $cabindetails,
            'warddetails' => $warddetails,
            'icudetails' => $icudetails,
            'beds' => $beds
        ]);
    }
    
    // public function getDataval(Request $request) {
    //     $beds = Bed::where('status', 'Active')->get();
    //     if ($request->flag == "cabin") {
    //         $cabininfo = Cabin::where('id', $request->id)->with('cabintype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$request->id)->where('type','cabin')->select('bed_no')->get();
    //         return response()->json(['beds' => $beds, 'cabininfo' => $cabininfo,'bedassigned'=>$bedassigned]);
    //     } else if ($request->flag == "ward") {
    //         $wardinfo = Ward::where('id', $request->id)->with('wardtype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$request->id)->where('type','ward')->select('bed_no')->get();
    //         return response()->json(['beds' => $beds, 'wardinfo' => $wardinfo, 'bedassigned'=>$bedassigned]);
    //     } else if ($request->flag == "icu") {
    //         $icuinfo = Icu::where('id', $request->id)->with('icutype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$request->id)->where('type','icu')->select('bed_no')->get();
    //         return response()->json(['beds' => $beds, 'icuinfo' => $icuinfo, 'bedassigned'=>$bedassigned]);
    //     }
    // }

    public function getDataval($id,$flag) {
        $beds = Bed::where('status', 'Active')->get();
        if ($flag == "cabin") {
            $cabininfo = Cabin::where('id', $id)->with('cabintype','block','floor','bedAssign')->first();
            $bedassigned = BedAssign::where('type_id',$id)->where('type','cabin')->select('bed_no','bed_name')->get();
            if($bedassigned){
                return view("backend.bedassignformpage",['beds' => $beds, 'cabininfo' => $cabininfo,'bedassigned'=>$bedassigned]);
            }
            return view("backend.bedassignformpage",['beds' => $beds, 'cabininfo' => $cabininfo]);
        } else if ($flag == "ward") {
            $wardinfo = Ward::where('id', $id)->with('wardtype','block','floor','bedAssign')->first();
            $bedassigned = BedAssign::where('type_id',$id)->where('type','ward')->select('bed_no','bed_name')->get();
            if($bedassigned){
                return view("backend.bedassignformpage",['beds' => $beds, 'wardinfo' => $wardinfo, 'bedassigned'=>$bedassigned]);
            }
            return view("backend.bedassignformpage",['beds' => $beds, 'wardinfo' => $wardinfo]);
        } else if ($flag == "icu") {
            $icuinfo = Icu::where('id', $id)->with('icutype','block','floor','bedAssign')->first();
            $bedassigned = BedAssign::where('type_id',$id)->where('type','icu')->select('bed_no','bed_name')->get();
            if($bedassigned){
                return view("backend.bedassignformpage",['beds' => $beds, 'icuinfo' => $icuinfo, 'bedassigned'=>$bedassigned]);
            }
            return view("backend.bedassignformpage",['beds' => $beds, 'icuinfo' => $icuinfo]);
        }
    }
    


public function assignBed(Request $request)
{
    // Decode the bed numbers and bed names JSON
    $type = $request->flag;
    $id = $request->id;

    $typeClasses = [
        'cabin' => Cabin::class,
        'ward' => Ward::class,
        'icu' => Icu::class
    ];

    if (isset($typeClasses[$type])) {
        $class = $typeClasses[$type];
        $name = $class::where('id', $id)->value("{$type}_name");

        $bedNumbers = $request->input('bed_numbers'); // Assumes bedNumber is an array from the form
        $bedName = $request->input('bed_name'); // Assumes a single bed name selected from the dropdown

        foreach ($bedNumbers as $bedNumber) {
            $assignbed = BedAssign::create([
                "type" => $type,
                "type_name" => $name,
                "type_id" => $id,
                "floor_count" => $request->floor,
                "block_id" => $request->block,
                "bed_no" => $bedNumber,
                "bed_name" => $bedName
            ]);
        }

        return response()->json(["message" => "Beds assigned successfully"]);
    } else {
        return response()->json(["message" => "INVALID!!"]);
    }
}


    public function getDataValues($id, $type) {
        $beds = Bed::where('status', 'Active')->get();
        $data = BedAssign::where('type_id', $id)->where('type', $type)->first();
    
        if (!$data) {
            return response()->json(['message' => 'Bed assignment not found.']);
        }
    
        $bedname = json_decode($data->bed_name);
        $bednumber = json_decode($data->bed_no);
    
        $bedNames = [];
        foreach ($bedname as $bedId) {
            $bedName = Bed::where('id', $bedId)->value('bed_name');
            if ($bedName) {
                $bedNames[] = $bedName;
            }
        }
    
        $count = count($bedNames);
    
        return response()->json([
            'data' => [
                'beds' => $beds,
                'bedNames' => $bedNames,
                'bednumber' => $bednumber,
                'bedAssign' => $data,
                'count' => $count  // Include count of bedNames for dynamic select generation
            ]
        ]);
    }
    

    
    
}
