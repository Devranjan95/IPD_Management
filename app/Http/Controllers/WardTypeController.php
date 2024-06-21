<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\WardType;
use App\Models\Ward;

class WardTypeController extends Controller
{
    //
    public function index(){
        $wardtypes = WardType::where('status','!=','Deleted')->get();
        return view("backend.wardtypeMaster",['wardtypes'=>$wardtypes]);
    }
    public function saveWardType(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'wardtype' => 'required|string|max:50',
                'status' => 'required',
            ]);
            if($request->mode == "add"){
                $wardtypeexist = WardType::where('ward_type',$request->wardtype)->first();
                if($wardtypeexist){
                    if($wardtypeexist->status == "Deleted"){
                        $updatewardtype = WardType::where('id',$wardtypeexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updatewardtype){
                            return response()->json(["message"=>"Error!! Sorry wardtype already exists"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry wardtype already exists"]);
                    }
                }
                $saveWardType = WardType::create([
                    "ward_type"=>ucwords($request->wardtype),
                    "status"=>$request->status,
                    "narration"=>$request->narration,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveWardType){
                    return response()->json(['status'=>true,'message'=>'Wardtype saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Wardtype could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $wardtypeexists = WardType::where('status','!=','Deleted')->where('ward_type', $request->wardtype)->get();
                if($wardtypeexists){
                    foreach($wardtypeexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry wardtype already exists"]);
                        }
    
                    }
                }
                $updatewardtype = WardType::where('id',$request->recordid)
                                    ->update(["ward_type"=>ucwords($request->wardtype),
                                              "status"=>$request->status,
                                              "narration"=>$request->narration,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                // if($updatewardtype){
                //     return response()->json(['status'=>true,'message'=>'Wardtype updated successfully']);
                // }else{
                //     return response()->json(['status'=>false,'message'=>'Wardtype could not be updated']);
                // }
                if ($updatewardtype) {
                    // Update cabin status if necessary
                    if ($request->status == "Inactive") {
                        Ward::where("ward_type_id", $request->recordid)->update([
                            "status" => "Inactive"
                        ]);
                    } else {
                        Ward::where("ward_type_id", $request->recordid)->update([
                            "status" => "Active"
                        ]);
                    }
                    return response()->json(['status' => true, 'message' => 'Wardtype updated successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Wardtype could not be updated'], 500);
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
        $wardtype = WardType::where('id', $id)->first();
        return response()->json(['wardtype'=>$wardtype]);
    }
    public function deleteData(string $id)
    {
        $ward = Ward::where('ward_type_id',$id)->exists();
        if(!$ward){
            $wardtype = WardType::find($id);

            // Check if the floor record exists
            if (!$wardtype) {
                return response()->json(['message' => 'Wardtype not found'], 404);
            }

            // Attempt to delete the floor record
            if ($wardtype->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Wardtype Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Wardtype could not be deleted.',
                ]);
            }
        } else {
            // Associated records found, cannot delete floor
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete Wardtype. Associated records exist in  ward',
            ]);
        }  
    }
}
