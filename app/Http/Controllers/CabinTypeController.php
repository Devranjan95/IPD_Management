<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\CabinType;

class CabinTypeController extends Controller
{
    //
    public function index(){
        $cabintypes = CabinType::where('status','!=','Deleted')->get();
        return view("backend.cabintypeMaster",['cabintypes'=>$cabintypes]);
    }
    public function saveCabinType(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'cabintype' => 'required|string|max:15',
                'status' => 'required',
            ]);
            if($request->mode == "add"){
                $cabintypeexist = CabinType::where('cabin_type',$request->cabintype)->first();
                if($cabintypeexist){
                    if($cabintypeexist->status == "Deleted"){
                        $updatecabintype = CabinType::where('id',$cabintypeexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updatecabintype){
                            return response()->json(["message"=>"Error!! Sorry CabinType already exists"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry CabinType already exists"]);
                    }
                }
                $saveCabinType = CabinType::create([
                    "cabin_type"=>$request->cabintype,
                    "status"=>$request->status,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveCabinType){
                    return response()->json(['status'=>true,'message'=>'CabinType Saved Successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'CabinType could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $cabintypeexists = CabinType::where('status','!=','Deleted')->where('cabin_type', $request->cabintype)->get();
                if($cabintypeexists){
                    foreach($cabintypeexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry CabinType already exists"]);
                        }
    
                    }
                }
                $updatecabintype = CabinType::where('id',$request->recordid)
                                    ->update(["cabin_type"=>$request->cabintype,
                                              "status"=>$request->status,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updatecabintype){
                    return response()->json(['status'=>true,'message'=>'CabinType Updated Successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'CabinType could not be updated']);
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
        $cabintype = CabinType::where('id', $id)->first();
        return response()->json(['cabintype'=>$cabintype]);
    }
    public function deleteData(string $id)
    {
        //dd($id);
        $floor = CabinType::find($id);
        if(!$floor){
            return response()->json(['message'=>'CabinType Not Found']);
        }

        $update = CabinType::where('id',$id)
            ->update([
                'updated_at'  => date('Y-m-d H:i:s'),
                'updated_by'  => "1",
                'status'      => 'Deleted'
            ]);

            if($update){
                return response()->json([
                    'status' => true,
                    'message' => 'CabinType deleted',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => "CabinType could not be deleted.",
                ]);
            }
    }
}
