<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BedCategory;

class BedCategoryController extends Controller
{
    //
    public function index(){
        $bedcategories = BedCategory::where('status','!=','Deleted')->get();
        return view('backend.bedcategoryMaster',['bedcategories'=>$bedcategories]);
    }

    public function saveBedCateggory(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'bedcategory' => 'required|string|max:20',
                'status' => 'required',
            ]);
           // dd($request->all());
            if($request->mode == "add"){
                //dd($request->all());
                $bedcategoryexist = BedCategory::where('bed_category',$request->bedcategory)->first();
                if($bedcategoryexist){
                    //dd($amenityexist);
                    if($bedcategoryexist->status == "Deleted"){
                        $updatebedcategory = BedCategory::where('id',$bedcategoryexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updatebedcategory){
                            return response()->json(["message"=>"Bed category saved successfully"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry Bed category already exists"]);
                    }
                }
                $saveBedcategory = BedCategory::create([
                    "bed_category"=>ucwords($request->bedcategory),
                    "status"=>$request->status,
                    "narration"=>$request->narration,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveBedcategory){
                    return response()->json(['status'=>true,'message'=>'Bed category saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Bed category could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $bedcategoryexists = BedCategory::where('status','!=','Deleted')->where('bed_category', $request->bedcategory)->get();
                if($bedcategoryexists){
                    foreach($bedcategoryexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry Bed category already exists"]);
                        }
    
                    }
                }
                $updatebedcategory = BedCategory::where('id',$request->recordid)
                                    ->update(["bed_category"=>ucwords($request->bedcategory),
                                              "status"=>$request->status,
                                              "narration"=>$request->narration,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updatebedcategory){
                    return response()->json(['status'=>true,'message'=>'Bed category updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Bed category could not be updated']);
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
        $bedcategory = BedCategory::where('id', $id)->first();
        return response()->json(['bedcategory'=>$bedcategory]);
    }
    public function deleteData(string $id)
    {
        $bedcategory = BedCategory::find($id);

        // Check if the floor record exists
        if (!$bedcategory) {
            return response()->json(['message' => 'Bed category not found'], 404);
        }

        // Attempt to delete the floor record
        if ($bedcategory->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Bed category Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bed category could not be deleted.',
            ]);
        }
    
    }
}
