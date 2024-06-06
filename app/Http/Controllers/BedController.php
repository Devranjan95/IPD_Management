<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;

class BedController extends Controller
{
    //
    public function index(){
        $floors = Floor::where('status','=','Active')->pluck('floor_no','id');
        return view("backend.bedMaster",['floors'=>$floors]);
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

    public function showRooms(Request $request){
        //dd($request);
       $cabins = Cabin::where('block_id',$request->block)->select('cabin_name','occupancy')->get();
       $wards = Ward::where('block_id',$request->block)->select('ward_name','occupancy')->get();
       $icus = Icu::where('block_id',$request->block)->select('icu_name','occupancy')->get();
       $response = [];
       if ($cabins->isNotEmpty()) {
           $response['cabins'] = $cabins;
       }
       if ($wards->isNotEmpty()) {
           $response['wards'] = $wards;
       }
       if ($icus->isNotEmpty()) {
           $response['icus'] = $icus;
       }
       return response()->json($response);
    }
}
