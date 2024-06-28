<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BedCategory;
use App\Models\Bed;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;
use App\Models\BedAssign;

class BedController extends Controller
{
    //
    // public function index(){
    //     $bedcategory = BedCategory::where('status','Active')->pluck('bed_category','id');
    //     $beds = Bed::where('status','!=','Deleted')->get();
    //     $bedtypename = []; // Initialize the array
    //     $bedcategoryname = []; 
    //     $bedcatstatus = [];// Initialize the array
    //     $floors = Floor::where('status','Active')->pluck('floor_no','id');
    //     foreach($beds as $bed){
    //         $bedcategoryname[] = BedCategory::where('id',$bed->bed_category_id)->value('bed_category');
    //         $bedcatstaus[] = BedCategory::where('id',$bed->bed_category_id)->value('status');
    //     }
    //     return view("backend.bedMaster",['bedcategory'=>$bedcategory,
    //                                      'beds'=>$beds,
    //                                      'bedtypename'=>$bedtypename,
    //                                      'bedcategoryname'=>$bedcategoryname,
    //                                      'floors'=>$floors,
    //                                      ]);
    // }
    public function index()
{
    $bedcategory = BedCategory::where('status', 'Active')->pluck('bed_category', 'id');
    $beds = Bed::where('status', '!=', 'Deleted')->get();
    $bedcategoryname = [];
    $bedcategorystatus = [];

    foreach ($beds as $bed) {
        $bedCategory = BedCategory::where('id', $bed->bed_category_id)->first();
        $bedcategoryname[] = $bedCategory->bed_category;
        $bedcategorystatus[] = $bedCategory->status;
    }

    $floors = Floor::where('status', 'Active')->pluck('floor_no', 'id');

    return view("backend.bedMaster", [
        'bedcategory' => $bedcategory,
        'beds' => $beds,
        'bedcategoryname' => $bedcategoryname,
        'bedcategorystatus' => $bedcategorystatus,
        'floors' => $floors,
    ]);
}


    public function showBlocks(Request $request){
        //dd($request);
        $blocks = Block::where('status','Active')->where('floor_id',$request->floor)->pluck('block_code','id');
        if($blocks){
            return response()->json(['blocks'=>$blocks]);
        }else{
            return response()->json(['message'=>"Sorry no blocks found for the given floor"]);
        }
    }

    public function saveBed(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'bedname' => 'required',
                'status' => 'required',
            ]);
           // dd($request->all());
            if($request->mode == "add"){
                //dd($request->all());
                $bedexist = Bed::where('bed_name',$request->bedname)->where('bed_category_id',$request->bed_category_id)->first();
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
                $assigned = 0;
                $saveBed = Bed::create([
                    "bed_name"=>ucwords($request->bedname),
                    "bed_category_id"=>$request->bed_category_id,
                    "no_of_beds"=>$request->no_of_beds,
                    "assigned_no"=>$assigned,
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
                $bedexists = Bed::where('status','!=','Deleted')->where('bed_name', $request->bedname)->where('bed_category_id',$request->bed_category_id)->get();
                if($bedexists){
                    foreach($bedexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry Bed already exists"]);
                        }
    
                    }
                }
                $check = BedAssign::where('bed_name',$request->recordid)->exists();
                if(!$check){
                    $updatebed = Bed::where('id',$request->recordid)
                    ->update(["bed_name"=>ucwords($request->bedname),
                              "bed_category_id"=>$request->bed_category_id,
                              "no_of_beds"=>$request->no_of_beds,
                              "status"=>$request->status,
                              "narration"=>$request->narration,
                              "updated_by"=>1,
                              "updated_at"=>date('Y-m-d H:i:s')]);
                    if($updatebed){
                        return response()->json(['status'=>true,'message'=>'Bed updated successfully']);
                    }else{
                        return response()->json(['status'=>false,'message'=>'Bed could not be updated']);
                    }
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Cannot update status. Bed in use',
                    ]);
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
