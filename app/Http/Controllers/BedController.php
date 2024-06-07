<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BedCategory;
use App\Models\BedType;
use App\Models\Bed;

class BedController extends Controller
{
    //
    public function index(){
        $bedcategory = BedCategory::where('status','Active')->pluck('bed_category','id');
        $bedtype = BedType::where('status','Active')->pluck('bed_type','id');
        $beds = Bed::where('status','!=','Deleted')->get();
        foreach($beds as $bed){
            $bedtypename[] = BedType::where('id',$bed->bed_type_id)->value('bed_type');
            $bedcategoryname[] = BedCategory::where('id',$bed->bed_category_id)->value('bed_category');
        }
        return view("backend.bedMaster",['bedcategory'=>$bedcategory,'bedtype'=>$bedtype,'beds'=>$beds,'bedtypename'=>$bedtypename,'bedcategoryname'=>$bedcategoryname]);
    }

    public function saveBed(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'bedname' => 'required|string|max:20',
                'status' => 'required',
            ]);
           // dd($request->all());
            if($request->mode == "add"){
                //dd($request->all());
                $bedexist = Bed::where('bed_name',$request->bedname)->where('bed_type_id',$request->bed_type_id)->where('bed_category_id',$request->bed_category_id)->first();
                if($bedexist){
                    //dd($amenityexist);
                    if($bedexist->status == "Deleted"){
                        $updatebed = Bed::where('id',$bedexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updatebed){
                            return response()->json(["message"=>"Bed saved successfully"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry Bed already exists"]);
                    }
                }
                $saveBed = Bed::create([
                    "bed_name"=>ucwords($request->bedname),
                    "bed_type_id"=>$request->bed_type_id,
                    "bed_category_id"=>$request->bed_category_id,
                    "status"=>$request->status,
                    "narration"=>$request->narration,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveBed){
                    return response()->json(['status'=>true,'message'=>'Bed saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Bed could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $bedexists = Bed::where('status','!=','Deleted')->where('bed_name', $request->bedname)->where('bed_type_id',$request->bed_type_id)->where('bed_category_id',$request->bed_category_id)->get();
                if($bedexists){
                    foreach($bedexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry Bed already exists"]);
                        }
    
                    }
                }
                $updatebed = Bed::where('id',$request->recordid)
                                    ->update(["bed_name"=>ucwords($request->bedname),
                                              "bed_type_id"=>$request->bed_type_id,
                                              "bed_category_id"=>$request->bed_category_id,
                                              "status"=>$request->status,
                                              "narration"=>$request->narration,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updatebed){
                    return response()->json(['status'=>true,'message'=>'Bed updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Bed could not be updated']);
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
        $bed = Bed::where('id', $id)->first();
        return response()->json(['bed'=>$bed]);
    }

    public function deleteData(string $id)
    {
        $bed = Bed::find($id);

        // Check if the floor record exists
        if (!$bed) {
            return response()->json(['message' => 'Bed not found'], 404);
        }

        // Attempt to delete the floor record
        if ($bed->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Bed Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bed could not be deleted.',
            ]);
        }
    
    }
}
