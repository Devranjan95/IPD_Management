<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Ward;
use App\Models\WardType;
use App\Models\Amenity;


class WardController extends Controller
{
    //
    public function index(){
        $wardtypes = WardType::where('status','Active')->pluck('ward_type','id');
        $floors = Floor::where('status','Active')->pluck('floor_no','id');
        $amenities = Amenity::where('status','Active')->pluck('amenities','id');
        $wards = Ward::where('status','!=','Deleted')->get();
    
        $wardDetails = []; // Array to store cabin details
    
        foreach($wards as $ward){
            $wardDetails[] = [
                'ward_type' => WardType::where('id',$ward->ward_type_id)->value('ward_type'),
                'floor_no' => Floor::where('id',$ward->floor_id)->value('floor_no'),
                'block_name' => Block::where('id',$ward->block_id)->value('block_name'),
            ];
        }
    
        return view('backend.wardMaster', [
            'wardtypes' => $wardtypes,
            'floors' => $floors,
            'amenities' => $amenities,
            'wards' => $wards,
            'wardDetails' => $wardDetails, // Pass the details to the view
        ]);
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

    public function saveWard(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'wardname' => 'required',
                'wardtype' => 'required',
                'floor' => 'required',
                'block' => 'required',
                'occupancy' => 'required|numeric',
                'amenities' => 'required|array',
                'wardprice' => 'required|numeric',
                'status' => 'required',
            ]);
            $amenities = implode(',', $request->amenities);
            //dd($request->cabintype);
            if($request->mode == "add"){
                //dd($request->all());
                $wardexist = Ward::where('ward_name',$request->wardname)->where('floor_id',$request->floor)->first();
                //dd($cabinexist);
                if($wardexist){
                    //dd(1);
                    return response()->json(["message"=>"Error!! Sorry ward already exists"]);    
                }
                $assigned = 0;
                $saveWard = Ward::create([
                    "ward_name" => ucwords($request->wardname),
                    "ward_type_id" => $request->wardtype, // Make sure to include cabin_type_id
                    "floor_id" => $request->floor,
                    "block_id" => $request->block,
                    "total_occupancy" => $request->occupancy,
                    "assigned"=>$assigned,
                    "amenities" => $amenities,
                    "price" => $request->wardprice,
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "created_by" => 1,
                    "updated_by" => 1
                ]);
                if($saveWard){
                    return response()->json(['status'=>true,'message'=>'Ward saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Ward could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $wardexists =  Ward::where('ward_name',$request->wardname)->where('floor_id',$request->floor)->get();
                if($wardexists){
                    foreach($wardexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry ward already exists"]);
                        }
    
                    }
                }
                
                $updateward = Ward::where('id',$request->recordid)
                                    ->update(["ward_name" => ucwords($request->wardname),
                                              "ward_type_id" => $request->wardtype, // Make sure to include cabin_type_id
                                              "floor_id" => $request->floor,
                                              "block_id" => $request->block,
                                              "total_occupancy" => $request->occupancy,
                                              "amenities" => $amenities,
                                              "price" => $request->wardprice,
                                              "status" => $request->status,
                                              "narration" => $request->narration,
                                              "created_by" => 1,
                                              "updated_by" => 1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updateward){
                    return response()->json(['status'=>true,'message'=>'Ward updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Ward could not be updated']);
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
        $ward = Ward::where('id', $id)->first();
        return response()->json(['ward'=>$ward]);
    }

    public function deleteData(string $id)
    {
        // Find the cabin record by ID
        $ward = Ward::find($id);

        // Check if the floor record exists
        if (!$ward) {
            return response()->json(['message' => 'Ward not found'], 404);
        }

        // Attempt to delete the floor record
        if ($ward->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Ward Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Ward could not be deleted.',
            ]);
        }
    }
}
