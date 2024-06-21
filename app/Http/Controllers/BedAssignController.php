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
    
    public function getDataval(Request $request) {
        $beds = Bed::where('status', 'Active')->get();
        if ($request->flag == "cabin") {
            $cabininfo = Cabin::where('id', $request->id)->first();
            $cabintype = CabinType::where('id', $cabininfo->cabin_type_id)->value('cabin_type');
            $floor = Floor::where('count', $cabininfo->floor_count)->value('floor_no');
            $block = Block::where('id', $cabininfo->block_id)->value('block_name');
            return response()->json(['beds' => $beds, 'cabininfo' => $cabininfo, 'cabintype' => $cabintype, 'floor' => $floor, 'block' => $block]);
        } else if ($request->flag == "ward") {
            $wardinfo = Ward::where('id', $request->id)->first();
            $wardtype = WardType::where('id', $wardinfo->ward_type_id)->value('ward_type');
            $floor = Floor::where('count', $wardinfo->floor_count)->value('floor_no');
            $block = Block::where('id', $wardinfo->block_id)->value('block_name');
            return response()->json(['beds' => $beds, 'wardinfo' => $wardinfo, 'wardtype' => $wardtype, 'floor' => $floor, 'block' => $block]);
        } else if ($request->flag == "icu") {
            $icuinfo = Icu::where('id', $request->id)->first();
            $icutype = IcuType::where('id', $icuinfo->icu_type_id)->value('icu_type');
            $floor = Floor::where('count', $icuinfo->floor_count)->value('floor_no');
            $block = Block::where('id', $icuinfo->block_id)->value('block_name');
            return response()->json(['beds' => $beds, 'icuinfo' => $icuinfo, 'icutype' => $icutype, 'floor' => $floor, 'block' => $block]);
        }
    }
    
    public function assignBed(Request $request){
        $bedNumbersJson = json_encode($request->bedNumber);
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
            
            $assignbed = BedAssign::insert([
                "type" => $type,
                "type_name" => $name,
                "floor" => $request->floor,
                "block" => $request->block,
                "bed_no" => $bedNumbersJson,
                "bed_name" => $request->bedname
            ]);
    
            if ($assignbed) {
                Bed::where('id', $request->bedname)->update(['assigned_no' => count($request->bedNumber)]);
                $class::where('id', $id)->update(['assigned' => count($request->bedNumber)]);
                return response()->json(["message" => "Bed assigned to the $type"]);
            } else {
                return response()->json(["message" => "Bed cannot be assigned to the $type"]);
            }
        } else {
            return response()->json(["message" => "INVALID!!"]);
        }
    }
    
}
