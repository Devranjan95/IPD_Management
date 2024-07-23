<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;
use App\Models\Bed;
use App\Models\WardType;
use App\Models\CabinType;
use App\Models\IcuType;
use App\Models\BedAssign;


class BedAssignController extends Controller
{

    public function newIndex(){
        $floors = Floor::all();
        $cabindetails = [];
        $warddetails = [];
        $icudetails = [];
        $beds = Bed::where('status','Active')->get();
        //$beds = Bed::all();
        foreach ($floors as $floor) {
            $cabins = Cabin::where('floor_count', $floor->count) 
                            ->select('id','cabin_name', 'total_occupancy', 'assigned','status')
                            ->get();
            $wards = Ward::where('floor_count', $floor->count) 
                            ->select('id','ward_name', 'total_occupancy', 'assigned','status')
                            ->get(); 
            $icus = Icu::where('floor_count', $floor->count) 
                            ->select('id','icu_name', 'total_occupancy', 'assigned','status')
                            ->get();                 
            $cabindetails[$floor->count] = $cabins;
            $warddetails[$floor->count] = $wards;
            $icudetails[$floor->count] = $icus;
        }
    
        return view('backend.Masters.Bed.bedassignvisual', [
            'floors' => $floors,
            'cabindetails' => $cabindetails,
            'warddetails' => $warddetails,
            'icudetails' => $icudetails,
            'beds' => $beds
        ]);
    }
    
    // public function getDataval(Request $request) {
    //     $beds = Bed::where('status', 'Active')->get();
    //     if ($request->flag == "cabin") {
    //         $cabininfo = Cabin::where('id', $request->id)->with('cabintype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$request->id)->where('type','cabin')->select('bed_no')->get();
    //         return response()->json(['beds' => $beds, 'cabininfo' => $cabininfo,'bedassigned'=>$bedassigned]);
    //     } else if ($request->flag == "ward") {
    //         $wardinfo = Ward::where('id', $request->id)->with('wardtype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$request->id)->where('type','ward')->select('bed_no')->get();
    //         return response()->json(['beds' => $beds, 'wardinfo' => $wardinfo, 'bedassigned'=>$bedassigned]);
    //     } else if ($request->flag == "icu") {
    //         $icuinfo = Icu::where('id', $request->id)->with('icutype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$request->id)->where('type','icu')->select('bed_no')->get();
    //         return response()->json(['beds' => $beds, 'icuinfo' => $icuinfo, 'bedassigned'=>$bedassigned]);
    //     }
    // }

    // public function getDataval($id,$flag) {
    //     //$beds = Bed::where('status', 'Active')->get();
    //     $beds = Bed::all();
    //     if ($flag == "cabin") {
    //         $cabininfo = Cabin::where('id', $id)->with('cabintype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$id)->where('type','cabin')->select('bed_no','bed_name','type')->get()->groupBy('bed_name');
    //         foreach($bedassigned as $bedName => $assignedGroup){
    //             $bedname = Bed::where('id',$bedName)->value('bed_name');
    //             //dd($bedname);
    //         }
    //         if($bedassigned){
    //             return view("backend.bedassignformpage",['beds' => $beds, 'cabininfo' => $cabininfo,'bedassigned'=>$bedassigned]);
    //         }
    //         return view("backend.bedassignformpage",['beds' => $beds, 'cabininfo' => $cabininfo]);
    //     } else if ($flag == "ward") {
    //         $wardinfo = Ward::where('id', $id)->with('wardtype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$id)->where('type','ward')->select('bed_no','bed_name','type')->get()->groupBy('bed_name');
    //         //dd($bedassigned);
    //         foreach($bedassigned as $bedName => $assignedGroup){
    //             $bedname = Bed::where('id',$bedName)->value('bed_name');
    //             //dd($bedname);
    //         }
    //         //print_r($bedassigned);exit;
    //         if($bedassigned){
    //             return view("backend.bedassignformpage",['beds' => $beds, 'wardinfo' => $wardinfo, 'bedassigned'=>$bedassigned]);
    //         }
    //         return view("backend.bedassignformpage",['beds' => $beds, 'wardinfo' => $wardinfo]);
    //     } else if ($flag == "icu") {
    //         $icuinfo = Icu::where('id', $id)->with('icutype','block','floor','bedAssign')->first();
    //         $bedassigned = BedAssign::where('type_id',$id)->where('type','icu')->select('bed_no','bed_name','type')->get()->groupBy('bed_name');
    //         foreach($bedassigned as $bedName => $assignedGroup){
    //             $bedname = Bed::where('id',$bedName)->value('bed_name');
    //             //dd($bedname);
    //         }
    //         if($bedassigned){
    //             return view("backend.bedassignformpage",['beds' => $beds, 'icuinfo' => $icuinfo, 'bedassigned'=>$bedassigned,'bedname'=>$bedname]);
    //         }
    //         return view("backend.bedassignformpage",['beds' => $beds, 'icuinfo' => $icuinfo,'bedname'=>$bedname]);
    //     }
    // }
    public function getDataval($id, $flag) {
        $beds = Bed::all();
        $viewData = ['beds' => $beds];
    
        if ($flag == "cabin") {
            $cabininfo = Cabin::where('id', $id)->with('cabintype', 'block', 'floor', 'bedAssign')->first();
            $bedassigned = BedAssign::where('type_id', $id)->where('type', 'cabin')->select('bed_no', 'bed_name', 'type')->get()->groupBy('bed_name');
            $viewData['cabininfo'] = $cabininfo;
        } else if ($flag == "ward") {
            $wardinfo = Ward::where('id', $id)->with('wardtype', 'block', 'floor', 'bedAssign')->first();
            $bedassigned = BedAssign::where('type_id', $id)->where('type', 'ward')->select('bed_no', 'bed_name', 'type')->get()->groupBy('bed_name');
            $viewData['wardinfo'] = $wardinfo;
        } else if ($flag == "icu") {
            $icuinfo = Icu::where('id', $id)->with('icutype', 'block', 'floor', 'bedAssign')->first();
            $bedassigned = BedAssign::where('type_id', $id)->where('type', 'icu')->select('bed_no', 'bed_name', 'type')->get()->groupBy('bed_name');
            $viewData['icuinfo'] = $icuinfo;
        }
    
        // Debugging output
        //dd($bedassigned);
    
        foreach ($bedassigned as $bedName => $assignedGroup) {
            $bedname = Bed::where('id', $bedName)->value('bed_name');
            //dd($bedname);
            foreach ($assignedGroup as $assigned) {
                $assigned->bed_name = $bedname; // Assign bed name to each assigned bed
                //dd($assigned->bed_name);
            }
        }
    
        $viewData['bedassigned'] = $bedassigned;
        //dd($viewData);
    
        return view("backend.Masters.Bed.bedassignformpage", $viewData);
    }
    
    
    
    


public function assignBed(Request $request)
{
    // Decode the bed numbers and bed names JSON
    $type = $request->flag;
    $id = $request->id;
    $typename = $request->tname;
    $price = $request->price;
    $category = $request->cattype;
    $categoryid = $request->cattypeid;
    //dd($price);
    //dd($typename);
    $typeClasses = [
        'cabin' => Cabin::class,
        'ward' => Ward::class,
        'icu' => Icu::class
    ];

    if (isset($typeClasses[$type])) {
        $class = $typeClasses[$type];
        $name = $class::where('id', $id)->value("{$type}_name");

        $bedNumbers = $request->input('bed_numbers'); // Assumes bedNumber is an array from the form
        $bedid = $request->input('bed_id'); // Assumes a single bed name selected from the dropdown
        foreach ($bedNumbers as $bedNumber) {
            $assignbed = BedAssign::create([
                "type" => $type,
                "type_name" => $name,
                "type_id" => $id,
                "bed_price" => $price,
                "category" => $category,
                "category_id" =>  $categoryid,
                "floor_count" => $request->floor,
                "block_id" => $request->block,
                "bed_no" => $bedNumber,
                "bed_name" => $bedid,
                "status" => "Vacant"
            ]);
        }
        $bedassign = BedAssign::where('type_name',$typename)->select('bed_no')->get();
        //dd($bedassign);
        $bednameassign = BedAssign::where('bed_name',$bedid)->get();
        //dd($bednameassign);
        $countbeds = count($bedassign);//errorr in updating
        //dd($countbeds);
        $countbedname = count($bednameassign);//error in updating
        //dd($countbedname);
        if($bedassign){
            $updateBedAssign = Bed::where('id',$bedid)->update(["assigned_no"=>$countbedname]);
            $updatetype = $class::where('id',$id)->update(["assigned"=>$countbeds]);
            if($updateBedAssign && $updatetype){
                return response()->json(["message" => "Beds assigned successfully"]);
            }else{
                return response()->json(["message" => "Something went wrong"]);
            }
        }
    } else {
        return response()->json(["message" => "INVALID!!"]);
    }
}


    public function removeBed(Request $request){
        $type = $request->type;
        $typeClasses = [
            'cabin' => Cabin::class,
            'ward' => Ward::class,
            'icu' => Icu::class
        ];
        if (isset($typeClasses[$type])){
            $class = $typeClasses[$type];
            $bednumId = BedAssign::where('bed_no',$request->bedNum)->select('id','type_id')->first();
            //dd($request->bedName);
            $id = BedAssign::find($bednumId->id);
            //$bednumId = intval($bednumId);
            if($id->delete()){
                $bedassignvalue = Bed::where("id",$request->bedName)->value("assigned_no");
                //dd($bedassignvalue);
                $bedclassUpdate = $class::where('id',$bednumId->type_id)->value("assigned");
                //dd($bedclassUpdate);
                $bedassignvalue = $bedassignvalue - 1;
                $bedclassUpdate = $bedclassUpdate - 1;
                $updatebed = Bed::where("id",$request->bedName)->update(["assigned_no"=>$bedassignvalue]);
                $updateclass = $class::where('id',$bednumId->type_id)->update(["assigned"=>$bedclassUpdate]);
                if($updatebed && $updateclass){
                    return response()->json(['status'=>true,"message"=>"The bed number removed successfully"]);
                }else{
                    return response()->json(['status'=>false,"message"=>"Something went wrong"]);
                }
                
            }else{
                return response()->json(['status'=>false,"message"=>"The bed number could not be removed"]);
            }
            //dd($bednumId);
        }
    }

    public function getDataValues($id, $type) {
        $beds = Bed::where('status', 'Active')->get();
        $data = BedAssign::where('type_id', $id)->where('type', $type)->first();
    
        if (!$data) {
            return response()->json(['message' => 'Bed assignment not found.']);
        }
    
        $bedname = json_decode($data->bed_name);
        $bednumber = json_decode($data->bed_no);
    
        $bedNames = [];
        foreach ($bedname as $bedId) {
            $bedName = Bed::where('id', $bedId)->value('bed_name');
            if ($bedName) {
                $bedNames[] = $bedName;
            }
        }
    
        $count = count($bedNames);
    
        return response()->json([
            'data' => [
                'beds' => $beds,
                'bedNames' => $bedNames,
                'bednumber' => $bednumber,
                'bedAssign' => $data,
                'count' => $count  // Include count of bedNames for dynamic select generation
            ]
        ]);
    }
    

    
    
}
