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


class BedAssignController extends Controller
{
    //
    public function index(){
        $floors = Floor::where('status','Active')->pluck('floor_no','id');
        return view('backend.assignBed',['floors'=>$floors]);
    }
    public function showBlocks(Request $request){
        //dd($request);
        $blocks = Block::where('status','Active')->where('floor_id',$request->floor)->pluck('block_code','id');
        if($blocks){
            return response()->json(['blocks'=>$blocks]);
        }else{
            return response()->json(['message'=>"Sorry no blocks found for the given floor"]);
        }
    }
    public function typeAvailable(Request $request){
        //dd($request);
        if($request->value == "cabin"){
            $cabins = Cabin::where('status','Active')->get();
            //dd($cabins);
            $cabinDetails = []; 
            foreach($cabins as $cabin){
                $cabinDetails[] = [
                    'cabin_type' => CabinType::where('id',$cabin->cabin_type_id)->value('cabin_type'),
                    'floor_no' => Floor::where('id',$cabin->floor_id)->value('floor_no'),
                    'block_name' => Block::where('id',$cabin->block_id)->value('block_name'),
                ];
            }
            if($cabins->isNotEmpty()){
                return response()->json(['message'=>'Cabins found','cabins'=>$cabins,'cabinDetails'=>$cabinDetails]);
            }else{
                return response()->json(['message'=>"No cabins found"]);
            }
        }
        if($request->value == "ward"){
            $wards = Ward::where('status','Active')->get();
            //dd($cabins);
            $wardDetails = []; 
            foreach($wards as $ward){
                $wardDetails[] = [
                    'ward_type' => WardType::where('id',$ward->ward_type_id)->value('ward_type'),
                    'floor_no' => Floor::where('id',$ward->floor_id)->value('floor_no'),
                    'block_name' => Block::where('id',$ward->block_id)->value('block_name'),
                ];
            }
            if($wards->isNotEmpty()){
                return response()->json(['message'=>'Wards found','wards'=>$wards,'wardDetails'=>$wardDetails]);
            }else{
                return response()->json(['message'=>"No wards found"]);
            }
        }
        if($request->value == "icu"){
            $icus = Icu::where('status','Active')->get();
            //dd($cabins);
            $icuDetails = []; 
            foreach($icus as $icu){
                $icuDetails[] = [
                    'icu_type' => IcuType::where('id',$icu->icu_type_id)->value('icu_type'),
                    'floor_no' => Floor::where('id',$icu->floor_id)->value('floor_no'),
                    'block_name' => Block::where('id',$icu->block_id)->value('block_name'),
                ];
            }
            if($icus->isNotEmpty()){
                return response()->json(['message'=>'ICUs found','icus'=>$icus,'icuDetails'=>$icuDetails]);
            }else{
                return response()->json(['message'=>"No icu's found"]);
            }
        }
    }
    public function showOccupancy($id, $flag) {
        if ($flag == "cabin") {
            $cabin = Cabin::where('id', $id)->first();
            if ($cabin) {
                return view("backend.bedassigningform", ["type" => "cabin", "data" => $cabin]);
            }
        } elseif ($flag == "ward") {
            $ward = Ward::where('id', $id)->first();
            if ($ward) {
                return view("backend.bedassigningform", ["type" => "ward", "data" => $ward]);
            }
        } elseif ($flag == "icu") {
            $icu = Icu::where('id', $id)->first();
            if ($icu) {
                return view("backend.bedassigningform", ["type" => "icu", "data" => $icu]);
            }
        }
        return redirect()->back()->with('error', 'Invalid flag or ID');
    }

    // public function newIndex(){
    //     $floors = Floor::where('status','Active')->get();
    //     $floorcount = [];
    //     $cabindetails = [];
    //     foreach($floors as $floor){
    //         $floorcount[] = $floor->count;
    //     }
    //     foreach($floorcount as $key=>$value){
    //         $cabins = Cabin::where('floor_count',$value)->where('status','Active')->select('cabin_name','total_occupancy','assigned')->get();
    //         $cabindetails[]=$cabins;
    //     }
    //     print_r($cabindetails);
    //     exit;
    //     return view('backend.bedassignvisual',['floors'=>$floors]);
    // }
    public function newIndex(){
        $floors = Floor::where('status', 'Active')->get();
        $cabindetails = [];
        $warddetails = [];
        $icudetails = [];
        $beds = Bed::where('status','Active')->get();
        foreach ($floors as $floor) {
            $cabins = Cabin::where('floor_count', $floor->count) 
                            ->where('status', 'Active')
                            ->select('id','cabin_name', 'total_occupancy', 'assigned')
                            ->get();
            $wards = Ward::where('floor_count', $floor->count) 
                            ->where('status', 'Active')
                            ->select('id','ward_name', 'total_occupancy', 'assigned')
                            ->get(); 
            $icus = Icu::where('floor_count', $floor->count) 
                            ->where('status', 'Active')
                            ->select('id','icu_name', 'total_occupancy', 'assigned')
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
        ]);
    }
    

    // public function getDataval(Request $request){
    //     $beds = Bed::where('status', 'Active')->get();
    //     if($request->flag == "cabin"){
    //         $cabininfo = Cabin::where('id',$request->id)->first();
    //         $cabintype = CabinType::where('id',$cabininfo->cabin_type_id)->value('cabin_type');
    //         $floor = Floor::where('count',$cabininfo->floor_count)->value('floor_no');
    //         $block = Block::where('id',$cabininfo->block_id)->value('block_name');
    //         return response()->json(['beds'=>$beds,'cabininfo'=>$cabininfo,'cabintype'=>$cabintype,
    //                                  "floor"=>$floor,'block'=>$block ]);
    //     }else if($request->flag == "ward"){
    //         $wardinfo = Ward::where('id',$request->id)->first();
    //         $wardtype = WardType::where('id',$wardinfo->ward_type_id)->value('ward_type');
    //         $floor = Floor::where('count',$wardinfo->floor_count)->value('floor_no');
    //         $block = Block::where('id',$wardinfo->block_id)->value('block_name');
    //         return response()->json(['beds'=>$beds,'wardinfo'=>$wardinfo,'wardtype'=>$wardtype,
    //                                  "floor"=>$floor,'block'=>$block ]);
    //     }else if($request->flag == "icu"){
    //         $icuinfo = Icu::where('id',$request->id)->first();
    //         $icutype = IcuType::where('id',$icuinfo->icu_type_id)->value('icu_type');
    //         $floor = Floor::where('count',$icuinfo->floor_count)->value('floor_no');
    //         $block = Block::where('id',$icuinfo->block_id)->value('block_name');
    //         return response()->json(['beds'=>$beds,'icuinfo'=>$icuinfo,'icutype'=>$icutype,
    //                                  "floor"=>$floor,'block'=>$block ]);
    //     }
    // }
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
    
    
    
    
    
    
    
    public function getblockDetails(Request $request){
        //dd($request);
        $blocks = Block::where('floor_id',$request->floor)->get();
        if($blocks->isEmpty()){
            return response()->json(['message'=>'No blocks found']);
        }else{
            return response()->json(['blocks'=>$blocks]);
        }
    }
    public function getRoomDetails(Request $request){
        $cabins = Cabin::where('floor_id', $request->floor)
                       ->where('block_id', $request->block)
                       ->get();
    
        $wards = Ward::where('floor_id', $request->floor)
                     ->where('block_id', $request->block)
                     ->get();
    
        $icus = Icu::where('floor_id', $request->floor)
                   ->where('block_id', $request->block)
                   ->get();
    
        $response = [];
    
        if (!$cabins->isEmpty()) {
            $response['cabins'] = $cabins;
        } 
    
        if (!$wards->isEmpty()) {
            $response['wards'] = $wards;
        } 
    
        if (!$icus->isEmpty()) {
            $response['icus'] = $icus;
        } 
    
        // Check if any rooms found
        if (empty($response)) {
            return response()->json(['message' => 'No rooms found']);
        } else {
            return response()->json($response);
        }
    }
    
}
