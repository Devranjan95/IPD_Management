<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    //
    public function index(){
        $amenities = Amenity::where('status',"!=","Deleted")->get();
        return view('backend.amenityMaster',['amenities'=>$amenities]);
    }
    public function saveAmenity(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'amenity' => 'required|string|max:15',
                'status' => 'required',
            ]);
           // dd($request->all());
            if($request->mode == "add"){
                //dd($request->all());
                $amenityexist = Amenity::where('amenities',$request->amenity)->first();
                if($amenityexist){
                    //dd($amenityexist);
                    if($amenityexist->status == "Deleted"){
                        $updateamenity = Amenity::where('id',$amenityexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updateamenity){
                            return response()->json(["message"=>"Amenity Saved Successfully"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry Amenity already exists"]);
                    }
                }
                $saveAmenity = Amenity::create([
                    "amenities"=>$request->amenity,
                    "status"=>$request->status,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveAmenity){
                    return response()->json(['status'=>true,'message'=>'Amenity Saved Successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Amenity could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $amenityexists = Amenity::where('status','!=','Deleted')->where('amenities', $request->amenity)->get();
                if($amenityexists){
                    foreach($amenityexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry Amenity already exists"]);
                        }
    
                    }
                }
                $updateamenity = Amenity::where('id',$request->recordid)
                                    ->update(["amenities"=>$request->amenity,
                                              "status"=>$request->status,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updateamenity){
                    return response()->json(['status'=>true,'message'=>'Amenity Updated Successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Amenity could not be updated']);
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
        $amenity = Amenity::where('id', $id)->first();
        return response()->json(['amenity'=>$amenity]);
    }
    public function deleteData(string $id)
    {
        //dd($id);
        $amenity = Amenity::find($id);
        if(!$amenity){
            return response()->json(['message'=>'Amenity Not Found']);
        }

        $update = Amenity::where('id',$id)
            ->update([
                'updated_at'  => date('Y-m-d H:i:s'),
                'updated_by'  => "1",
                'status'      => 'Deleted'
            ]);

            if($update){
                return response()->json([
                    'status' => true,
                    'message' => 'Amenity deleted',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => "Amenity could not be deleted.",
                ]);
            }
    }
}