<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\WardType;
use App\Models\CabinType;


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
    }
}
