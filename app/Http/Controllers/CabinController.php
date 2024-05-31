<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\CabinType;
use App\Models\Amenity;


class CabinController extends Controller
{
    //
    public function index(){
        $cabintypes = CabinType::where('status','Active')->pluck('cabin_type','id');
        $floors = Floor::where('status','Active')->pluck('floor_no','id');
        $amenities = Amenity::where('status','Active')->pluck('amenities','id');
        return view('backend.cabinMaster',['cabintypes'=>$cabintypes,'floors'=>$floors,'amenities'=>$amenities]);
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

    public function saveCabin(Request $request){
        dd($request->all());
        try{
            if($request->mode == "add"){
                $saveCabin = Cabin::create([
                    "cabin_name"=>$request->cabinname,
                    "cabin_type"=>$request->cabintype,
                    "floor_id"=>$request->floor,
                    "block_id"=>$request->block,
                    "occupancy"=>$request->occupancy,
                    "amenities"=>$request->amenities,
                    "price"=>$request->price,
                    "status"=>$request->status,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveCabin){
                    return response()->json(['status'=>true,'message'=>'Cabin Saved Successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Cabin could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
               
                
            }
        }catch (ValidationException $e){
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
     
    }
}
