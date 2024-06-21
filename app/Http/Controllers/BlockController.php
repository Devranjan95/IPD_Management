<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    //
    // public function index(){
    //     $blocks = Block::where('status', '!=', 'Deleted')->get();
    //     $floors = Floor::where('status', 'Active')->pluck('floor_no', 'count');
    //     $floorno = [];

    //     foreach ($blocks as $block) {
    //         $floor = Floor::where('count', $block->floor_count)->first(); // Fetch the Floor model
    //         if($floor->status == "Active"){
    //             $fl = "Parent Active";
    //         }else{
    //             $fl = "Parent Inactive";
    //         }           
    //         if ($floor) {
    //             $floorno[] = $floor->floor_no;
    //         } else {
    //             $floorno[] = ''; // Or handle accordingly if floor is not found
    //         }
    //     }

    //     return view("backend.blockMaster", compact('blocks', 'floors', 'floorno','fl'));
    // }

    public function index(){
        $blocks = Block::where('status', '!=', 'Deleted')->get();
        $floors = Floor::where('status', 'Active')->pluck('floor_no', 'count');
        $floorStatuses = [];
    
        foreach ($blocks as $block) {
            $floor = Floor::where('count', $block->floor_count)->first();
            if ($floor) {
                $floorStatuses[$block->id] = $floor->status;
            } else {
                $floorStatuses[$block->id] = 'Unknown';
            }
        }
    
        return view("backend.blockMaster", compact('blocks', 'floors', 'floorStatuses'));
    }
    
    
    // public function saveBlock(Request $request){
    //     //dd($request->all());
    //     try{
    //         $request->validate([
    //             'blockname'=> 'required|string|max:60',
    //             'floorNo' => 'required|integer',
    //             'status' => 'required',
    //         ]);
    //         //dd(1);
    //         $blockcode = ucwords($request->blockname)."-".$request->floorNo;
    //         if($request->mode == "add"){
    //             $blockexist = Block::where('block_code',$blockcode)->first();
    //             if($blockexist){
    //                 //dd(1);
    //                 return response()->json(["message"=>"Error!! Sorry block already exists"]);
                    
    //             }
    //             //dd($request->floorNo);
    //             $saveBlock = Block::create([
    //                 "block_name"=>ucwords($request->blockname),
    //                 "block_code"=>$blockcode,
    //                 "floor_count"=>$request->floorNo,
    //                 "status"=>$request->status,
    //                 "narration"=>$request->narration,
    //                 "created_by"=>1,
    //                 "updated_by"=>1
    //             ]);
    //             if($saveBlock){
    //                 //dd(1);
    //                 return response()->json(['status'=>true,'message'=>'Block saved successfully']);
    //             }else{
    //                 return response()->json(['status'=>true,'message'=>'Block could not be saved']);
    //             }
    //         }
    //         if($request->mode == "edit"){
    //             //dd($request->recordid);
    //             $blockexists = Block::where('block_code', $blockcode)->where('id', '!=', $request->recordid)->first();
    //         if ($blockexists) {
    //             return response()->json(['status' => false, 'message' => "Error!! Sorry block already exists"]);
    //         }
    //             // $blockexists = Block::where('block_code',$request->blockcode)->get();
    //             // if($blockexists){
    //             //     foreach($blockexists as $ex){
    //             //         if($request->recordid != $ex->id){
    //             //             return response()->json(['status' => false, 'message' => "Error!! Sorry block already exists"]);
    //             //         }
    
    //             //     }
    //             // }
    //             $updateblock = Block::where('id',$request->recordid)
    //                                 ->update(["block_name"=>ucwords($request->blockname),
    //                                           "block_code"=>$blockcode,
    //                                           "floor_count"=>$request->floorNo,
    //                                           "status"=>$request->status,
    //                                           "narration"=>$request->narration,
    //                                           "updated_by"=>1,
    //                                           "updated_at"=>date('Y-m-d H:i:s')]);
    //             if($updateblock){
    //                // dd($request->status);
    //                if($request->status == 'Inactive'){
    //                     $associatedCabins = Cabin::where('block_id',$request->recordid)->get();
    //                     $associatedWards = Ward::where('block_id',$request->recordid)->get();
    //                     $associatedIcus = Icu::where('block_id',$request->recordid)->get();
    //                     if( $associatedCabins->isEmpty() ||  $associatedWards->isEmpty()
    //                             || $associatedIcus->isEmpty()){
    //                             return response()->json(['status' => true, 'message' => 'Block updated successfully']);
    //                     } else {
                           
    //                         Cabin::where('block_id', $request->recordid)
    //                         ->update([
    //                             'status' => 'Inactive',
    //                             'updated_by' => 1,
    //                             'updated_at' => date('Y-m-d H:i:s')
    //                         ]);
    //                         Ward::where('block_id', $request->recordid)
    //                         ->update([
    //                             'status' => 'Inactive',
    //                             'updated_by' => 1,
    //                             'updated_at' => date('Y-m-d H:i:s')
    //                         ]);
    //                         Icu::where('block_id', $request->recordid)
    //                         ->update([
    //                             'status' => 'Inactive',
    //                             'updated_by' => 1,
    //                             'updated_at' => date('Y-m-d H:i:s')
    //                         ]);
    //                         return response()->json(['status' => true, 'message' => 'Block updated successfully']);
    //                     }
    //                 }else{
                        
    //                     Cabin::where('block_id', $request->recordid)
    //                     ->update([
    //                         'status' => 'Active',
    //                         'updated_by' => 1,
    //                         'updated_at' => date('Y-m-d H:i:s')
    //                     ]);
    //                     Ward::where('block_id', $request->recordid)
    //                     ->update([
    //                         'status' => 'Active',
    //                         'updated_by' => 1,
    //                         'updated_at' => date('Y-m-d H:i:s')
    //                     ]);
    //                     Icu::where('block_id', $request->recordid)
    //                     ->update([
    //                         'status' => 'Active',
    //                         'updated_by' => 1,
    //                         'updated_at' => date('Y-m-d H:i:s')
    //                     ]);
    //                 }
    //                 return response()->json(['status'=>true,'message'=>'Block updated successfully']);
    //             }else{
    //                 return response()->json(['status'=>false,'message'=>'Block could not be updated']);
    //             }
                
    //         }
    //     }catch (ValidationException $e){
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $e->errors()
    //         ], 422);
    //     }
     
    // }
    public function saveBlock(Request $request){
        try {
            $request->validate([
                'blockname'=> 'required|string|max:60',
                'floorNo' => 'required|integer',
                'status' => 'required',
            ]);
    
            $blockcode = ucwords($request->blockname)."-".$request->floorNo;
            if ($request->mode == "add") {
                $blockexist = Block::where('block_code', $blockcode)->first();
                if ($blockexist) {
                    return response()->json(["message"=>"Error!! Sorry block already exists"]);
                }
    
                $saveBlock = Block::create([
                    "block_name" => ucwords($request->blockname),
                    "block_code" => $blockcode,
                    "floor_count" => $request->floorNo,
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "created_by" => 1,
                    "updated_by" => 1
                ]);
    
                if ($saveBlock) {
                    return response()->json(['status' => true, 'message' => 'Block saved successfully']);
                } else {
                    return response()->json(['status' => true, 'message' => 'Block could not be saved']);
                }
            }
    
            if ($request->mode == "edit") {
                $blockexists = Block::where('block_code', $blockcode)
                                    ->where('id', '!=', $request->recordid)
                                    ->first();
    
                if ($blockexists) {
                    return response()->json(['status' => false, 'message' => "Error!! Sorry block already exists"]);
                }
    
                DB::beginTransaction();
    
                try {
                    $updateblock = Block::where('id', $request->recordid)
                                        ->update([
                                            "block_name" => ucwords($request->blockname),
                                            "block_code" => $blockcode,
                                            "floor_count" => $request->floorNo,
                                            "status" => $request->status,
                                            "narration" => $request->narration,
                                            "updated_by" => 1,
                                            "updated_at" => now()
                                        ]);
    
                    if ($updateblock) {
                        if ($request->status == 'Inactive') {
                            $associatedCabins = Cabin::where('block_id', $request->recordid)->get();
                            $associatedWards = Ward::where('block_id', $request->recordid)->get();
                            $associatedIcus = Icu::where('block_id', $request->recordid)->get();
    
                            if ($associatedCabins->isEmpty() && $associatedWards->isEmpty() && $associatedIcus->isEmpty()) {
                                DB::commit();
                                return response()->json(['status' => true, 'message' => 'Block updated successfully']);
                            } else {
                                Cabin::where('block_id', $request->recordid)
                                    ->update([
                                        'status' => 'Inactive',
                                        'updated_by' => 1,
                                        'updated_at' => now()
                                    ]);
    
                                Ward::where('block_id', $request->recordid)
                                    ->update([
                                        'status' => 'Inactive',
                                        'updated_by' => 1,
                                        'updated_at' => now()
                                    ]);
    
                                Icu::where('block_id', $request->recordid)
                                    ->update([
                                        'status' => 'Inactive',
                                        'updated_by' => 1,
                                        'updated_at' => now()
                                    ]);
    
                                DB::commit();
                                return response()->json(['status' => true, 'message' => 'Block updated successfully']);
                            }
                        } else {
                            Cabin::where('block_id', $request->recordid)
                                ->update([
                                    'status' => 'Active',
                                    'updated_by' => 1,
                                    'updated_at' => now()
                                ]);
    
                            Ward::where('block_id', $request->recordid)
                                ->update([
                                    'status' => 'Active',
                                    'updated_by' => 1,
                                    'updated_at' => now()
                                ]);
    
                            Icu::where('block_id', $request->recordid)
                                ->update([
                                    'status' => 'Active',
                                    'updated_by' => 1,
                                    'updated_at' => now()
                                ]);
    
                            DB::commit();
                            return response()->json(['status' => true, 'message' => 'Block updated successfully']);
                        }
                    } else {
                        DB::rollBack();
                        return response()->json(['status' => false, 'message' => 'Block could not be updated']);
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Block update failed: ' . $e->getMessage());
                    return response()->json(['status' => false, 'message' => 'An error occurred while updating the block']);
                }
            }
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }
    public function getData(string $id)
    {   
        //dd($id);
        $block = Block::where('id', $id)->first();
        return response()->json(['block'=>$block]);
    }
    public function deleteData(string $id)
    {
        $cabins = Cabin::where('block_id', $id)->exists();
        $wards = Ward::where('block_id', $id)->exists();
        $icus = Icu::where('block_id', $id)->exists();
        if(!$cabins && !$wards && !$icus){
            $block = Block::find($id);

            // Check if the floor record exists
            if (!$block) {
                return response()->json(['message' => 'Block not found'], 404);
            }

            // Attempt to delete the floor record
            if ($block->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Block Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Block could not be deleted.',
                ]);
            }

        }else {
            // Associated records found, cannot delete floor
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete block. Associated records exist in cabin, ward, or icu.',
            ]);
        } 
    }
}
