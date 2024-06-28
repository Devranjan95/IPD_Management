<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Icu;
use App\Models\IcuType;
use App\Models\Amenity;


class IcuController extends Controller
{
    //

    public function index(){
        $icutypes = IcuType::where('status', 'Active')->pluck('icu_type', 'id');
        $floors = Floor::where('status', 'Active')->pluck('floor_no', 'count');
        $amenities = Amenity::where('status', 'Active')->pluck('amenities', 'id');
        $icus = Icu::where('status', '!=', 'Deleted')->get();
    
        $icuDetails = []; // Array to store cabin details
        
        foreach ($icus as $icu) {
            $floor = Floor::where('count', $icu->floor_count)->first(); // Get floor details
            $block = Block::where('id', $icu->block_id)->first(); // Get block details
            $icutype = IcuType::where('id',$icu->icu_type_id)->first();
            $icuDetails[] = [
                'icu_type' => IcuType::where('id', $icu->icu_type_id)->value('icu_type'),
                'floor_no' => $floor ? $floor->floor_no : null,
                'block_name' => $block ? $block->block_name : null,
                'floor_status' => $floor ? $floor->status : null, // Add floor status
                'block_status' => $block ? $block->status : null,  // Add block status
                'icutype_status'=>$icutype ? $icutype->status : null
            ];
        }
    
        return view('backend.icuMaster', [
            'icutypes' => $icutypes,
            'floors' => $floors,
            'amenities' => $amenities,
            'icus' => $icus,
            'icuDetails' => $icuDetails, // Pass the details to the view
        ]);
    }
    
    

    public function showBlocks(Request $request){
        //dd($request);
        $blocks = Block::where('status','Active')->where('floor_count',$request->floor)->pluck('block_code','id');
        if($blocks){
            return response()->json(['blocks'=>$blocks]);
        }else{
            return response()->json(['message'=>"Sorry no blocks found for the given floor"]);
        }
    }

    public function saveIcu(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'icuname' => 'required',
                'icutype' => 'required',
                'floor' => 'required',
                'block' => 'required',
                'occupancy' => 'required|numeric',
                'amenities' => 'required|array',
                'icuprice' => 'required|numeric',
                'status' => 'required',
            ]);
            $amenities = implode(',', $request->amenities);
            //dd($request->cabintype);
            if($request->mode == "add"){
                //dd($request->all());
                $icuexist = Icu::where('icu_name',$request->icuname)->where('floor_count',$request->floor)->first();
                //dd($cabinexist);
                if($icuexist){
                    //dd(1);
                    return response()->json(["message"=>"Error!! Sorry ICU already exists"]);    
                }
                $assigned = 0;
                $saveIcu = Icu::create([
                    "icu_name" => ucwords($request->icuname),
                    "icu_type_id" => $request->icutype, // Make sure to include cabin_type_id
                    "floor_count" => $request->floor,
                    "block_id" => $request->block,
                    "total_occupancy" => $request->occupancy,
                    "assigned"=>$assigned,
                    "amenities" => $amenities,
                    "price" => $request->icuprice,
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "created_by" => 1,
                    "updated_by" => 1
                ]);
                if($saveIcu){
                    return response()->json(['status'=>true,'message'=>'ICU saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'ICU could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $icuexists =  Icu::where('icu_name',$request->icuname)->where('floor_count',$request->floor)->get();
                if($icuexists){
                    foreach($icuexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry ICU already exists"]);
                        }
    
                    }
                }
                
                $updateicu = Icu::where('id',$request->recordid)
                                    ->update(["icu_name" => ucwords($request->icuname),
                                              "icu_type_id" => $request->icutype, // Make sure to include cabin_type_id
                                              "floor_count" => $request->floor,
                                              "block_id" => $request->block,
                                              "total_occupancy" => $request->occupancy,
                                              "amenities" => $amenities,
                                              "price" => $request->icuprice,
                                              "status" => $request->status,
                                              "narration" => $request->narration,
                                              "created_by" => 1,
                                              "updated_by" => 1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updateicu){
                    return response()->json(['status'=>true,'message'=>'ICU updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'ICU could not be updated']);
                }
               
                
            }
        }catch (ValidationException $e){
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
     
    }

    public function getData(string $id)
    {   
        //dd($id);
        $icu = Icu::where('id', $id)->first();
        return response()->json(['icu'=>$icu]);
    }

    public function deleteData(string $id)
    {
        // Find the cabin record by ID
        $icu = Icu::find($id);

        // Check if the floor record exists
        if (!$icu) {
            return response()->json(['message' => 'ICU not found'], 404);
        }

        // Attempt to delete the floor record
        if ($icu->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'ICU Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'ICU could not be deleted.',
            ]);
        }
    }
}
