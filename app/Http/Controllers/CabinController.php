<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Token;
use App\Models\CabinType;
use App\Models\Amenity;


class CabinController extends Controller
{
    //
    // public function index(){
    //     $cabintypes = CabinType::where('status','Active')->pluck('cabin_type','id');
    //     $floors = Floor::where('status','Active')->pluck('floor_no','count');
    //     $amenities = Amenity::where('status','Active')->pluck('amenities','id');
    //     $cabins = Cabin::where('status','!=','Deleted')->get();
    
    //     $cabinDetails = []; // Array to store cabin details
    
    //     foreach($cabins as $cabin){
    //         $cabinDetails[] = [
    //             'cabin_type' => CabinType::where('id',$cabin->cabin_type_id)->value('cabin_type'),
    //             'floor_no' => Floor::where('count',$cabin->floor_count)->where('status','Active')->value('floor_no'),
    //             'block_name' => Block::where('id',$cabin->block_id)->value('block_name'),
    //         ];
    //     }
    
    //     return view('backend.cabinMaster', [
    //         'cabintypes' => $cabintypes,
    //         'floors' => $floors,
    //         'amenities' => $amenities,
    //         'cabins' => $cabins,
    //         'cabinDetails' => $cabinDetails, // Pass the details to the view
    //     ]);
    // }
    // public function index(){
    //     $cabintypes = CabinType::where('status', 'Active')->pluck('cabin_type', 'id');
    //     $floors = Floor::where('status', 'Active')->pluck('floor_no', 'count');
    //     $amenities = Amenity::where('status', 'Active')->pluck('amenities', 'id');
    //     $cabins = Cabin::where('status', '!=', 'Deleted')->get();
    
    //     $cabinDetails = []; // Array to store cabin details
        
    //     foreach ($cabins as $cabin) {
    //         $floor = Floor::where('count', $cabin->floor_count)->first(); // Get floor details
    //         $cabinDetails[] = [
    //             'cabin_type' => CabinType::where('id', $cabin->cabin_type_id)->value('cabin_type'),
    //             'floor_no' => $floor ? $floor->floor_no : null,
    //             'block_name' => Block::where('id', $cabin->block_id)->value('block_name'),
    //             'floor_status' => $floor ? $floor->status : null // Add floor status
    //         ];
    //     }
    
    //     return view('backend.cabinMaster', [
    //         'cabintypes' => $cabintypes,
    //         'floors' => $floors,
    //         'amenities' => $amenities,
    //         'cabins' => $cabins,
    //         'cabinDetails' => $cabinDetails, // Pass the details to the view
    //     ]);
    // }


    // public function index(){
    //     $cabintypes = CabinType::where('status', 'Active')->pluck('cabin_type', 'id');
    //     $floors = Floor::where('status', 'Active')->pluck('floor_no', 'count');
    //     $amenities = Amenity::where('status', 'Active')->pluck('amenities', 'id');
    //     $cabins = Cabin::where('status', '!=', 'Deleted')->get();
    
    //     $cabinDetails = []; // Array to store cabin details
        
    //     foreach ($cabins as $cabin) {
    //         $floor = Floor::where('count', $cabin->floor_count)->first(); // Get floor details
    //         $block = Block::where('id', $cabin->block_id)->first(); // Get block details
    //         $cabintype = CabinType::where('id',$cabin->cabin_type_id)->first();
            
    //         $cabinDetails[] = [
    //             'cabin_type' => CabinType::where('id', $cabin->cabin_type_id)->value('cabin_type'),
    //             'floor_no' => $floor ? $floor->floor_no : null,
    //             'block_name' => $block ? $block->block_name : null,
    //             'floor_status' => $floor ? $floor->status : null, // Add floor status
    //             'block_status' => $block ? $block->status : null,  // Add block status
    //             'cabintype_status' => $cabintype ? $cabintype->status : null
    //         ];
    //     }
    
    //     return view('backend.Masters.Cabin.cabinMaster', [
    //         'cabintypes' => $cabintypes,
    //         'floors' => $floors,
    //         'amenities' => $amenities,
    //         'cabins' => $cabins,
    //         'cabinDetails' => $cabinDetails, // Pass the details to the view
    //     ]);
    // }

    public function index(){
        $cabintypes = CabinType::where('status', 'Active')->pluck('cabin_type', 'id');
        $floors = Floor::where('status', 'Active')->pluck('floor_no', 'count');
        $amenitiesList = Amenity::where('status', 'Active')->pluck('amenities', 'id');
        $cabins = Cabin::where('status', '!=', 'Deleted')->get();
        
        $cabinDetails = []; // Array to store cabin details
        
        foreach ($cabins as $cabin) {
            $floor = Floor::where('count', $cabin->floor_count)->first(); // Get floor details
            $block = Block::where('id', $cabin->block_id)->first(); // Get block details
            $cabintype = CabinType::where('id', $cabin->cabin_type_id)->first();
            
            // Decode amenities and fetch their names
            $amenityIDs = [];
            if (!empty($cabin->amenities)) {
                if (is_array($cabin->amenities)) {
                    $amenityIDs = $cabin->amenities;
                } elseif (is_string($cabin->amenities)) {
                    $jsonDecoded = json_decode($cabin->amenities, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $amenityIDs = $jsonDecoded;
                    } else {
                        $amenityIDs = explode(',', $cabin->amenities);
                    }
                }
            }
    
            $amenityNames = Amenity::whereIn('id', $amenityIDs)->pluck('amenities')->toArray();
    
            $cabinDetails[] = [
                'cabin_type' => $cabintype->cabin_type ?? null,
                'floor_no' => $floor ? $floor->floor_no : null,
                'block_name' => $block ? $block->block_name : null,
                'floor_status' => $floor ? $floor->status : null, // Add floor status
                'block_status' => $block ? $block->status : null,  // Add block status
                'cabintype_status' => $cabintype ? $cabintype->status : null,
                'amenity_names' => $amenityNames // Add amenity names
            ];
        }
    
        return view('backend.Masters.Cabin.cabinMaster', [
            'cabintypes' => $cabintypes,
            'floors' => $floors,
            'amenities' => $amenitiesList,
            'cabins' => $cabins,
            'cabinDetails' => $cabinDetails, // Pass the details to the view
        ]);
    }
    
    
    
    
    

    public function showBlocks(Request $request){
        //dd($request);
        $blocks = Block::where('status','Active')->where('floor_count',$request->floor)->pluck('block_code','id');
        //dd($blocks);
        if($blocks){
            return response()->json(['blocks'=>$blocks]);
        }else{
            return response()->json(['message'=>"Sorry no blocks found for the given floor"]);
        }
    }

    public function saveCabin(Request $request){
        //dd($request->all());
        try{
            if(empty($request->amenities)){
                return response()->json(["status"=>false,"message"=>"!! Please select an amenity"]);
            }
            $request->validate([
                'cabinname' => 'required',
                'cabintype' => 'required',
                'floor' => 'required',
                'block' => 'required',
                'occupancy' => 'required|numeric',
                'available' => 'numeric',
                'amenities' => 'required|array',
                'cabinprice' => 'required|numeric',
                'status' => 'required',
            ]);
            $amenities = implode(',', $request->amenities);
            //dd($request->cabintype);
            if($request->mode == "add"){
                //dd($request->all());
                $cabinexist = Cabin::where('cabin_name',$request->cabinname)->first();
                //dd($cabinexist);
                if($cabinexist){
                    //dd(1);
                    return response()->json(["message"=>"Error!! Sorry cabin already exists"]);
                    
                }
                $assigned = 0;
                $saveCabin = Cabin::create([
                    "cabin_name" => ucwords($request->cabinname),
                    "cabin_type_id" => $request->cabintype, // Make sure to include cabin_type_id
                    "floor_count" => $request->floor,
                    "block_id" => $request->block,
                    "total_occupancy" => $request->occupancy,
                    "assigned"=>$assigned,
                    "amenities" => $amenities,
                    "price" => $request->cabinprice,
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "created_by" => 1,
                    "updated_by" => 1
                ]);
                if($saveCabin){
                    return response()->json(['status'=>true,'message'=>'Cabin saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Cabin could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $cabinexists = $cabinexist = Cabin::where('cabin_name',$request->cabinname)->get();
                if($cabinexists){
                    foreach($cabinexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry cabin already exists"]);
                        }
    
                    }
                }
                //$available = $request->occupancy - $assigned;
                if($request->status == "Inactive"){
                    $statusArray = ["Booked","InBed","Discharge InProgress"];
                    $cabinexist = Token::where('flag','Cabin')->where('type_name_id',$request->recordid)->whereIn('status', $statusArray)->get();
                    //dd($cabinexist);
                    if($cabinexist->isNotEmpty()){
                        return response()->json(["status"=>false,"message"=>"Sorry!! Cabin cannot be inactive, Patients alloted to the cabin"]);
                    }else{
                        //dd(1);
                        //This is if i want to update the childs of cabin............
                        $updatecabin = Cabin::where('id',$request->recordid)
                        ->update(["cabin_name" => ucwords($request->cabinname),
                                  "cabin_type_id" => $request->cabintype, // Make sure to include cabin_type_id
                                  "floor_count" => $request->floor,
                                  "block_id" => $request->block,
                                  "total_occupancy" => $request->occupancy,
                                  "amenities" => $amenities,
                                  "price" => $request->cabinprice,
                                  "status" => $request->status,
                                  "narration" => $request->narration,
                                  "created_by" => 1,
                                  "updated_by" => 1,
                                  "updated_at"=>date('Y-m-d H:i:s')]);
                        if($updatecabin){
                            return response()->json(['status'=>true,'message'=>'Cabin updated successfully']);
                        }else{
                            return response()->json(['status'=>false,'message'=>'Cabin could not be updated']);
                        }
                    }
                }else{
                    //dd(1);
                        $updatecabin = Cabin::where('id',$request->recordid)
                        ->update(["cabin_name" => ucwords($request->cabinname),
                                  "cabin_type_id" => $request->cabintype, // Make sure to include cabin_type_id
                                  "floor_count" => $request->floor,
                                  "block_id" => $request->block,
                                  "total_occupancy" => $request->occupancy,
                                  "amenities" => $amenities,
                                  "price" => $request->cabinprice,
                                  "status" => $request->status,
                                  "narration" => $request->narration,
                                  "created_by" => 1,
                                  "updated_by" => 1,
                                  "updated_at"=>date('Y-m-d H:i:s')]);
                        if($updatecabin){
                            return response()->json(['status'=>true,'message'=>'Cabin updated successfully']);
                        }else{
                            return response()->json(['status'=>false,'message'=>'Cabin could not be updated']);
                        }
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
        $cabin = Cabin::where('id', $id)->first();
        return response()->json(['cabin'=>$cabin]);
    }

    public function deleteData(string $id)
    {
        $statusArray = ["Booked","InBed","Discharge InProgress"];
        $cabinexist = Token::where('flag','Cabin')->where('type_name_id',$id)->whereIn('status', $statusArray)->get();
        //dd($cabinexist);
        if($cabinexist->isNotEmpty()){
            return response()->json(["status"=>false,"message"=>"Sorry!! cannot delete this cabin, Patients alloted to the cabin"]);
        }else{
                // Find the cabin record by ID
            $cabin = Cabin::find($id);

            // Check if the floor record exists
            if (!$cabin) {
                return response()->json(['message' => 'Cabin not found'], 404);
            }

            // Attempt to delete the floor record
            if ($cabin->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Cabin Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Cabin could not be deleted.',
                ]);
            }
        }
    }
}
