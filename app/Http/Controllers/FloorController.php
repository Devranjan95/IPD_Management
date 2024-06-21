<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;

class FloorController extends Controller
{
    //
    public function index(){
        $floordata = Floor::where('status','!=','Deleted')->get();
        return view("backend.floorMaster",['floordata'=>$floordata]);
    }

    // public function saveFloor(Request $request){
    //     //dd($request->all());
    //     // Define the path to the floor count file
    //     $counterFile = storage_path('app/floorcount.txt');
    //     $counter = intval(file_get_contents($counterFile));

    //     try{
    //         $request->validate([
    //             'floorNo' => 'required|string|max:15',
    //             'status' => 'required',
    //         ]);
    //         if($request->mode == "add"){
    //             $floorexist = Floor::where('floor_no',$request->floorNo)->first();
    //             if($floorexist){
    //                 if($floorexist->status == "Deleted"){
    //                     $updatefloor = Floor::where('id',$floorexist->id)
    //                                         ->update([
    //                                             "updated_by"=>1,
    //                                             "updated_at"=>date("Y-m-d H:i:s"),
    //                                             "status"=>$request->status
    //                                         ]);
    //                     if($updatefloor){
    //                         return response()->json(["message"=>"Error!! Sorry floor already exists"]);
    //                     }
    //                 }else{
    //                     return response()->json(["message"=>"Error!! Sorry floor already exists"]);
    //                 }
    //             }
    //             $saveFloor = Floor::create([
    //                 "count" => $counter,
    //                 "floor_no"=>ucwords($request->floorNo),
    //                 "status"=>$request->status,
    //                 "narration"=>$request->narration,
    //                 "created_by"=>1,
    //                 "updated_by"=>1
    //             ]);
    //             if($saveFloor){
    //                 // Increment the counter
    //                 $counter++;

    //                 // Write the updated counter value back to the file
    //                 file_put_contents($counterFile, $counter);
    //                 return response()->json(['status'=>true,'message'=>'Floor saved successfully']);
    //             }else{
    //                 return response()->json(['status'=>true,'message'=>'Floor could not be saved']);
    //             }
    //         }
    //         if($request->mode == "edit"){
    //             //dd($request->mode);
    //             $floorexists = Floor::where('status','!=','Deleted')->where('floor_no', $request->floorNo)->get();
    //             if($floorexists){
    //                 foreach($floorexists as $ex){
    //                     //dd($ex->count);//1
    //                     if($request->recordid != $ex->count){
    //                         return response()->json(['status' => false, 'message' => "Error!! Sorry floor already exists"]);
    //                     }
    
    //                 }
    //             }
                
    //             $updatefloor = Floor::where('count',$request->recordid)
    //                                 ->update(["floor_no"=>ucwords($request->floorNo),
    //                                           "status"=>$request->status,
    //                                           "narration"=>$request->narration,
    //                                           "updated_by"=>1,
    //                                           "updated_at"=>date('Y-m-d H:i:s')]);
    //             if($updatefloor){
                    
    //                 if($request->status == 'Inactive'){
    //                     $associatedBlocks = Block::where('floor_count', $request->recordid)->get();
    //                     $associatedCabins = Cabin::where('floor_count',$request->recordid)->get();
    //                     $associatedWards = Ward::where('floor_count',$request->recordid)->get();
    //                     $associatedIcus = Icu::where('floor_count',$request->recordid)->get();
    //                     if($associatedBlocks->isEmpty() || $associatedCabins->isEmpty() ||  $associatedWards->isEmpty()
    //                      || $associatedIcus->isEmpty()){
    //                         return response()->json(['status' => true, 'message' => 'Floor updated successfully']);
    //                     } else {
    //                         Block::where('floor_count', $request->recordid)
    //                              ->update([
    //                                  'status' => 'Inactive',
    //                                  'updated_by' => 1,
    //                                  'updated_at' => date('Y-m-d H:i:s')
    //                              ]);
    //                         Cabin::where('floor_count', $request->recordid)
    //                         ->update([
    //                             'status' => 'Inactive',
    //                             'updated_by' => 1,
    //                             'updated_at' => date('Y-m-d H:i:s')
    //                         ]);
    //                         Ward::where('floor_count', $request->recordid)
    //                         ->update([
    //                             'status' => 'Inactive',
    //                             'updated_by' => 1,
    //                             'updated_at' => date('Y-m-d H:i:s')
    //                         ]);
    //                         Icu::where('floor_count', $request->recordid)
    //                         ->update([
    //                             'status' => 'Inactive',
    //                             'updated_by' => 1,
    //                             'updated_at' => date('Y-m-d H:i:s')
    //                         ]);
    //                         return response()->json(['status' => true, 'message' => 'Floor updated successfully']);
    //                     }
    //                 }else{
    //                     Block::where('floor_count', $request->recordid)
    //                              ->update([
    //                                  'status' => 'Active',
    //                                  'updated_by' => 1,
    //                                  'updated_at' => date('Y-m-d H:i:s')
    //                              ]);
    //                     Cabin::where('floor_count', $request->recordid)
    //                     ->update([
    //                         'status' => 'Active',
    //                         'updated_by' => 1,
    //                         'updated_at' => date('Y-m-d H:i:s')
    //                     ]);
    //                     Ward::where('floor_count', $request->recordid)
    //                     ->update([
    //                         'status' => 'Active',
    //                         'updated_by' => 1,
    //                         'updated_at' => date('Y-m-d H:i:s')
    //                     ]);
    //                     Icu::where('floor_count', $request->recordid)
    //                     ->update([
    //                         'status' => 'Active',
    //                         'updated_by' => 1,
    //                         'updated_at' => date('Y-m-d H:i:s')
    //                     ]);
    //                 }
    //                 return response()->json(['status'=>true,'message'=>'Floor updated successfully']);
    //             }else{
    //                 return response()->json(['status'=>false,'message'=>'Floor could not be updated']);
    //             }
                
    //         }
    //     }catch (ValidationException $e){
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $e->errors()
    //         ], 422);
    //     }
     
    // }
    public function saveFloor(Request $request){
        // Define the path to the floor count file
        $counterFile = storage_path('app/floorcount.txt');
        $counter = intval(file_get_contents($counterFile));
    
        try {
            $request->validate([
                'floorNo' => 'required|string|max:15',
                'status' => 'required',
            ]);
    
            if ($request->mode == "add") {
                $floorexist = Floor::where('floor_no', $request->floorNo)->first();
                if ($floorexist) {
                    if ($floorexist->status == "Deleted") {
                        $updatefloor = Floor::where('id', $floorexist->id)
                                            ->update([
                                                "updated_by" => 1,
                                                "updated_at" => now(),
                                                "status" => $request->status
                                            ]);
                        if ($updatefloor) {
                            return response()->json(["message" => "Error!! Sorry floor already exists"]);
                        }
                    } else {
                        return response()->json(["message" => "Error!! Sorry floor already exists"]);
                    }
                }
    
                $saveFloor = Floor::create([
                    "count" => $counter,
                    "floor_no" => ucwords($request->floorNo),
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "created_by" => 1,
                    "updated_by" => 1
                ]);
    
                if ($saveFloor) {
                    // Increment the counter
                    $counter++;
                    // Write the updated counter value back to the file
                    file_put_contents($counterFile, $counter);
                    return response()->json(['status' => true, 'message' => 'Floor saved successfully']);
                } else {
                    return response()->json(['status' => true, 'message' => 'Floor could not be saved']);
                }
            }
    
            if ($request->mode == "edit") {
                $floorexists = Floor::where('status', '!=', 'Deleted')->where('floor_no', $request->floorNo)->get();
                if ($floorexists) {
                    foreach ($floorexists as $ex) {
                        if ($request->recordid != $ex->count) {
                            return response()->json(['status' => false, 'message' => "Error!! Sorry floor already exists"]);
                        }
                    }
                }
    
                DB::beginTransaction();
    
                try {
                    $updatefloor = Floor::where('count', $request->recordid)
                                        ->update([
                                            "floor_no" => ucwords($request->floorNo),
                                            "status" => $request->status,
                                            "narration" => $request->narration,
                                            "updated_by" => 1,
                                            "updated_at" => now()
                                        ]);
    
                    if ($updatefloor) {
                        if ($request->status == 'Inactive') {
                            $associatedBlocks = Block::where('floor_count', $request->recordid)->get();
                            $associatedCabins = Cabin::where('floor_count', $request->recordid)->get();
                            $associatedWards = Ward::where('floor_count', $request->recordid)->get();
                            $associatedIcus = Icu::where('floor_count', $request->recordid)->get();
    
                            if ($associatedBlocks->isEmpty() && $associatedCabins->isEmpty() && $associatedWards->isEmpty() && $associatedIcus->isEmpty()) {
                                DB::commit();
                                return response()->json(['status' => true, 'message' => 'Floor updated successfully']);
                            } else {
                                Block::where('floor_count', $request->recordid)
                                    ->update([
                                        'status' => 'Inactive',
                                        'updated_by' => 1,
                                        'updated_at' => now()
                                    ]);
    
                                Cabin::where('floor_count', $request->recordid)
                                    ->update([
                                        'status' => 'Inactive',
                                        'updated_by' => 1,
                                        'updated_at' => now()
                                    ]);
    
                                Ward::where('floor_count', $request->recordid)
                                    ->update([
                                        'status' => 'Inactive',
                                        'updated_by' => 1,
                                        'updated_at' => now()
                                    ]);
    
                                Icu::where('floor_count', $request->recordid)
                                    ->update([
                                        'status' => 'Inactive',
                                        'updated_by' => 1,
                                        'updated_at' => now()
                                    ]);
    
                                DB::commit();
                                return response()->json(['status' => true, 'message' => 'Floor updated successfully']);
                            }
                        } else {
                            Block::where('floor_count', $request->recordid)
                                ->update([
                                    'status' => 'Active',
                                    'updated_by' => 1,
                                    'updated_at' => now()
                                ]);
    
                            Cabin::where('floor_count', $request->recordid)
                                ->update([
                                    'status' => 'Active',
                                    'updated_by' => 1,
                                    'updated_at' => now()
                                ]);
    
                            Ward::where('floor_count', $request->recordid)
                                ->update([
                                    'status' => 'Active',
                                    'updated_by' => 1,
                                    'updated_at' => now()
                                ]);
    
                            Icu::where('floor_count', $request->recordid)
                                ->update([
                                    'status' => 'Active',
                                    'updated_by' => 1,
                                    'updated_at' => now()
                                ]);
    
                            DB::commit();
                            return response()->json(['status' => true, 'message' => 'Floor updated successfully']);
                        }
                    } else {
                        DB::rollBack();
                        return response()->json(['status' => false, 'message' => 'Floor could not be updated']);
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Floor update failed: ' . $e->getMessage());
                    return response()->json(['status' => false, 'message' => 'An error occurred while updating the floor']);
                }
            }
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }
    public function getData(string $count)
    {   
        //dd($id);
        $floor = Floor::where('count', $count)->first();
        return response()->json(['floor'=>$floor]);
    }
    // public function deleteData($id,$count)
    // {
    //     // Find the floor record by ID
    //     $block = Block::where('floor_count',$count)->get();
    //     $cabin = Cabin::where('floor_count',$count)->get();
    //     $ward = Ward::where('floor_count',$count)->get();
    //     $icu = Icu::where('floor_count',$count)->get();
    //     if()
    //     $floor = Floor::find($id);
    //     $counterFile = storage_path('app/floorcount.txt');
    //     $counter = intval(file_get_contents($counterFile));
    //     // Check if the floor record exists
    //     if (!$floor) {
    //         return response()->json(['message' => 'Floor not found'], 404);
    //     }

    //     // Attempt to delete the floor record
    //     if ($floor->delete()) {
    //         $counter--;
    //         file_put_contents($counterFile, $counter);
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Floor Deleted',
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Floor could not be deleted.',
    //         ]);
    //     }
    //     //dd($id);
    //     // $floor = Floor::find($id);
    //     // if(!$floor){
    //     //     return response()->json(['message'=>'Floor Not Found']);
    //     // }

    //     // $update = Floor::where('id',$id)
    //     //     ->update([
    //     //         'updated_at'  => date('Y-m-d H:i:s'),
    //     //         'updated_by'  => "1",
    //     //         'status'      => 'Deleted'
    //     //     ]);

    //     //     if($update){
    //     //         return response()->json([
    //     //             'status' => true,
    //     //             'message' => 'Floor deleted',
    //     //         ]);
    //     //     }else{
    //     //         return response()->json([
    //     //             'status' => false,
    //     //             'message' => "Floor could not be deleted.",
    //     //         ]);
    //     // }
    // }
    public function deleteData($id, $count)
{
    // Check if there are associated records in Block, Cabin, Ward, and ICU
    $blocks = Block::where('floor_count', $count)->exists();
    $cabins = Cabin::where('floor_count', $count)->exists();
    $wards = Ward::where('floor_count', $count)->exists();
    $icus = Icu::where('floor_count', $count)->exists();

    if (!$blocks && !$cabins && !$wards && !$icus) {
        // No associated records found, proceed with deletion
        $floor = Floor::find($id);

        if (!$floor) {
            return response()->json(['message' => 'Floor not found'], 404);
        }

        $counterFile = storage_path('app/floorcount.txt');
        $counter = intval(file_get_contents($counterFile));

        if ($floor->delete()) {
            $counter--;
            file_put_contents($counterFile, $counter);
            return response()->json([
                'status' => true,
                'message' => 'Floor Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Floor could not be deleted.',
            ]);
        }
    } else {
        // Associated records found, cannot delete floor
        return response()->json([
            'status' => false,
            'message' => 'Cannot delete floor. Associated records exist in block, cabin, ward, or icu.',
        ]);
    }
}


    
}
