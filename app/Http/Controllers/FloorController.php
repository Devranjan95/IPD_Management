<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;


class FloorController extends Controller
{
    //
    public function index(){
        $floordata = Floor::where('status','!=','Deleted')->get();
        return view("backend.floorMaster",['floordata'=>$floordata]);
    }

    public function saveFloor(Request $request){
        //dd($request->all());
        // Define the path to the floor count file
        $counterFile = storage_path('app/floorcount.txt');
        $counter = intval(file_get_contents($counterFile));

        try{
            $request->validate([
                'floorNo' => 'required|string|max:15',
                'status' => 'required',
            ]);
            if($request->mode == "add"){
                $floorexist = Floor::where('floor_no',$request->floorNo)->first();
                if($floorexist){
                    if($floorexist->status == "Deleted"){
                        $updatefloor = Floor::where('id',$floorexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updatefloor){
                            return response()->json(["message"=>"Error!! Sorry floor already exists"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry floor already exists"]);
                    }
                }
                $saveFloor = Floor::create([
                    "count" => $counter,
                    "floor_no"=>ucwords($request->floorNo),
                    "status"=>$request->status,
                    "narration"=>$request->narration,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveFloor){
                    // Increment the counter
                    $counter++;

                    // Write the updated counter value back to the file
                    file_put_contents($counterFile, $counter);
                    return response()->json(['status'=>true,'message'=>'Floor saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Floor could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $floorexists = Floor::where('status','!=','Deleted')->where('floor_no', $request->floorNo)->get();
                if($floorexists){
                    foreach($floorexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry floor already exists"]);
                        }
    
                    }
                }
                $updatefloor = Floor::where('id',$request->recordid)
                                    ->update(["floor_no"=>ucwords($request->floorNo),
                                              "status"=>$request->status,
                                              "narration"=>$request->narration,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updatefloor){
                    return response()->json(['status'=>true,'message'=>'Floor updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Floor could not be updated']);
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
        $floor = Floor::where('id', $id)->first();
        return response()->json(['floor'=>$floor]);
    }
    public function deleteData(string $id)
    {
        // Find the floor record by ID
        $floor = Floor::find($id);
        $counterFile = storage_path('app/floorcount.txt');
        $counter = intval(file_get_contents($counterFile));
        // Check if the floor record exists
        if (!$floor) {
            return response()->json(['message' => 'Floor not found'], 404);
        }

        // Attempt to delete the floor record
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
        //dd($id);
        // $floor = Floor::find($id);
        // if(!$floor){
        //     return response()->json(['message'=>'Floor Not Found']);
        // }

        // $update = Floor::where('id',$id)
        //     ->update([
        //         'updated_at'  => date('Y-m-d H:i:s'),
        //         'updated_by'  => "1",
        //         'status'      => 'Deleted'
        //     ]);

        //     if($update){
        //         return response()->json([
        //             'status' => true,
        //             'message' => 'Floor deleted',
        //         ]);
        //     }else{
        //         return response()->json([
        //             'status' => false,
        //             'message' => "Floor could not be deleted.",
        //         ]);
        // }
    }

    
}
