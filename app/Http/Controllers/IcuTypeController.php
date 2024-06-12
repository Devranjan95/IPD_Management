<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IcuType;

class IcuTypeController extends Controller
{
    //
    //
    public function index(){
        $icutypes = IcuType::where('status','!=','Deleted')->get();
        return view("backend.icutypeMaster",['icutypes'=>$icutypes]);
    }
    public function saveIcuType(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'icutype' => 'required|string|max:50',
                'status' => 'required',
            ]);
            if($request->mode == "add"){
                $icutypeexist = IcuType::where('icu_type',$request->icutype)->first();
                if($icutypeexist){
                    if($icutypeexist->status == "Deleted"){
                        $updateicutype = IcuType::where('id',$icutypeexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updateicutype){
                            return response()->json(["message"=>"Error!! Sorry ICU type already exists"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry ICU type already exists"]);
                    }
                }
                $saveIcuType = IcuType::create([
                    "icu_type"=>ucwords($request->icutype),
                    "status"=>$request->status,
                    "narration"=>$request->narration,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveIcuType){
                    return response()->json(['status'=>true,'message'=>'ICU type saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'ICU type could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $icutypeexists = IcuType::where('status','!=','Deleted')->where('icu_type', $request->icutype)->get();
                if($icutypeexists){
                    foreach($icutypeexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry ICU type already exists"]);
                        }
    
                    }
                }
                $updateicutype = IcuType::where('id',$request->recordid)
                                    ->update(["icu_type"=>ucwords($request->icutype),
                                              "status"=>$request->status,
                                              "narration"=>$request->narration,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updateicutype){
                    return response()->json(['status'=>true,'message'=>'ICU type updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'ICU type could not be updated']);
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
        $icutype = IcuType::where('id', $id)->first();
        return response()->json(['icutype'=>$icutype]);
    }
    public function deleteData(string $id)
    {
        $icutype = IcuType::find($id);

        // Check if the floor record exists
        if (!$icutype) {
            return response()->json(['message' => 'Wardtype not found'], 404);
        }

        // Attempt to delete the floor record
        if ($icutype->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'ICU type Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'ICU type could not be deleted.',
            ]);
        }
        //dd($id);
        // $floor = CabinType::find($id);
        // if(!$floor){
        //     return response()->json(['message'=>'Cabintype Not Found']);
        // }

        // $update = CabinType::where('id',$id)
        //     ->update([
        //         'updated_at'  => date('Y-m-d H:i:s'),
        //         'updated_by'  => "1",
        //         'status'      => 'Deleted'
        //     ]);

        //     if($update){
        //         return response()->json([
        //             'status' => true,
        //             'message' => 'Cabintype deleted',
        //         ]);
        //     }else{
        //         return response()->json([
        //             'status' => false,
        //             'message' => "CabinType could not be deleted.",
        //         ]);
        // }
    }
}
