<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BedType;

class BedTypeController extends Controller
{
    //
    public function index(){
        $bedtypes = BedType::where('status','!=','Deleted')->get();
        return view('backend.bedtypeMaster',['bedtypes'=>$bedtypes]);
    }

    public function saveBedtype(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'bedtype' => 'required|string|max:20',
                'status' => 'required',
            ]);
           // dd($request->all());
            if($request->mode == "add"){
                //dd($request->all());
                $bedtypeexist = BedType::where('bed_type',$request->bedtype)->first();
                if($bedtypeexist){
                    //dd($amenityexist);
                    if($bedtypeexist->status == "Deleted"){
                        $updatebedtype = BedType::where('id',$bedtypeexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updatebedtype){
                            return response()->json(["message"=>"Bed type saved successfully"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry Bed type already exists"]);
                    }
                }
                $saveBedtype = BedType::create([
                    "bed_type"=>ucwords($request->bedtype),
                    "status"=>$request->status,
                    "narration"=>$request->narration,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveBedtype){
                    return response()->json(['status'=>true,'message'=>'Bed type saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Bed type could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $bedtypeexists = BedType::where('status','!=','Deleted')->where('bed_type', $request->bedtype)->get();
                if($bedtypeexists){
                    foreach($bedtypeexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry Bed type already exists"]);
                        }
    
                    }
                }
                $updatebedtype = BedType::where('id',$request->recordid)
                                    ->update(["bed_type"=>ucwords($request->bedtype),
                                              "status"=>$request->status,
                                              "narration"=>$request->narration,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updatebedtype){
                    return response()->json(['status'=>true,'message'=>'Bed type updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Bed type could not be updated']);
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
        $bedtype = BedType::where('id', $id)->first();
        return response()->json(['bedtype'=>$bedtype]);
    }
    public function deleteData(string $id)
    {
        $bedtype = BedType::find($id);

        // Check if the floor record exists
        if (!$bedtype) {
            return response()->json(['message' => 'Bed type not found'], 404);
        }

        // Attempt to delete the floor record
        if ($bedtype->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Bed type Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bed type could not be deleted.',
            ]);
        }
    
    }
}
