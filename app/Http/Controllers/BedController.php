<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BedCategory;
use App\Models\BedType;
use App\Models\Bed;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;

class BedController extends Controller
{
    //
    public function index(){
        $bedcategory = BedCategory::where('status','Active')->pluck('bed_category','id');
        $bedtype = BedType::where('status','Active')->pluck('bed_type','id');
        $beds = Bed::where('status','!=','Deleted')->get();
        $bedtypename = []; // Initialize the array
        $bedcategoryname = []; // Initialize the array
        $floors = Floor::where('status','Active')->pluck('floor_no','id');
    //    **************************************************************************
//     $floorDetails = [];

//     foreach ($floors as $floorId => $floorNo) {
//         $cabinOccupancy = Cabin::where('status', 'Active')->where('floor_id', $floorId)->sum('total_occupancy');
//         $cabinAssigned = Cabin::where('status', 'Active')->where('floor_id', $floorId)->sum('assigned');

//         $wardOccupancy = Ward::where('status', 'Active')->where('floor_id', $floorId)->sum('total_occupancy');
//         $wardAssigned = Ward::where('status', 'Active')->where('floor_id', $floorId)->sum('assigned');

//         $icuOccupancy = Icu::where('status', 'Active')->where('floor_id', $floorId)->sum('total_occupancy');
//         $icuAssigned = Icu::where('status', 'Active')->where('floor_id', $floorId)->sum('assigned');

//         $floorDetails[$floorId] = [
//             'floor_no' => $floorNo,
//             'cabin' => [
//                 'total_occupancy' => $cabinOccupancy,
//                 'total_assigned' => $cabinAssigned,
//                 'available' => $cabinOccupancy - $cabinAssigned
//             ],
//             'ward' => [
//                 'total_occupancy' => $wardOccupancy,
//                 'total_assigned' => $wardAssigned,
//                 'available' => $wardOccupancy - $wardAssigned
//             ],
//             'icu' => [
//                 'total_occupancy' => $icuOccupancy,
//                 'total_assigned' => $icuAssigned,
//                 'available' => $icuOccupancy - $icuAssigned
//             ]
//         ];
//     }
// dd($floorDetails);
    // ********************************************************************************
        
        foreach($beds as $bed){
            $bedtypename[] = BedType::where('id',$bed->bed_type_id)->value('bed_type');
            $bedcategoryname[] = BedCategory::where('id',$bed->bed_category_id)->value('bed_category');
        }
        return view("backend.bedMaster",['bedcategory'=>$bedcategory,'bedtype'=>$bedtype,
                                         'beds'=>$beds,
                                         'bedtypename'=>$bedtypename,
                                         'bedcategoryname'=>$bedcategoryname,
                                         'floors'=>$floors,
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
                $assigned = 0;
                $saveBed = Bed::create([
                    "bed_name"=>ucwords($request->bedname),
                    "bed_type_id"=>$request->bed_type_id,
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
