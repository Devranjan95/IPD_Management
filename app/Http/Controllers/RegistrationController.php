<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\CabinType;
use App\Models\WardType;
use App\Models\IcuType;
use App\Models\Ward;
use App\Models\Icu;
use App\Models\BedAssign;
use App\Models\Patient;
use App\Models\Token;
use App\Models\IdProof;
use App\Models\SurgeryCount;
use App\Models\ObservationCount;
use Carbon\Carbon;

class RegistrationController extends Controller
{

    public function index() {
        $floors = Floor::all();
        $floorOccupancy = [];
    
        foreach ($floors as $fl) {
            // Collect block information and bed assignments
            $blockinfo = Block::where('floor_count', $fl->count)->get();
            $bedno = [];
            foreach ($blockinfo as $blk) {
                $bedassigninfo = BedAssign::where('block_id', $blk->id)->select('bed_no', 'type', 'status','type_name','category','bed_price')->get();
                $bedno[] = $bedassigninfo;
            }
    
            // Calculate bed counts for Cabin
            $cabincount = BedAssign::where('type', 'cabin')
                ->where('floor_count', $fl->count)->where('status','Vacant')
                ->count();
    
            // Calculate bed counts for Ward
            $wardcount = BedAssign::where('type', 'ward')
                ->where('floor_count', $fl->count)->where('status','Vacant')
                ->count();
    
            // Calculate bed counts for ICU
            $icucount = BedAssign::where('type', 'icu')
                ->where('floor_count', $fl->count)->where('status','Vacant')
                ->count();
    
            // Store the results in an array
            $floorOccupancy[] = [
                'floor_no' => $fl->floor_no,
                'total_occupancy_sum_cabin' => $cabincount,  // Adjusted variable name
                'total_occupancy_sum_ward' => $wardcount, // Adjusted variable name
                'total_occupancy_sum_icu' => $icucount, // Adjusted variable name
                'blockinfo' => $blockinfo,
                'bedno' => $bedno,
                'wardcount' => $wardcount, // Keeping the variable for ward count
                'cabincount' => $cabincount, // New variable for cabin count
                'icucount' => $icucount, // New variable for ICU count
            ];
        }
        //dd($floorOccupancy);
        // Return view with the data
        return view('backend.registration', ['floor' => $floors, 'floorOccupancy' => $floorOccupancy]);
    }
    

    public function getBedData($bednum){
        $bednum = str_replace('-', '/', $bednum);
        $regnNos = Patient::pluck('patient_regn_no','id');
        //dd($bednum);
        $beddata = BedAssign::where('bed_no',$bednum)->first();
        $floor = Floor::where('count',$beddata->floor_count)->value('floor_no');
        $block = Block::where('id',$beddata->block_id)->value('block_name');
        $idproof = IdProof::where('status','Active')->pluck('id_name','id');
        if($beddata->type == "cabin"){
            $cabininfo = Cabin::where('id',$beddata->type_id)->first();
            $type = CabinType::where('id',$cabininfo->cabin_type_id)->value('cabin_type');
            $bedinfo = [$beddata,$floor,$block,$cabininfo,$type];
        }elseif($beddata->type == "ward"){
            $wardinfo = Ward::where('id',$beddata->type_id)->first();
            $type = WardType::where('id',$wardinfo->ward_type_id)->value('ward_type');
            $bedinfo = [$beddata,$floor,$block,$wardinfo,$type];
        }else{
            $icuinfo = Icu::where('id',$beddata->type_id)->first();
            $type = IcuType::where('id',$icuinfo->icu_type_id)->value('icu_type');
            $bedinfo = [$beddata,$floor,$block,$icuinfo,$type];
        }
        $bedinfo[] = $regnNos;
        $bedinfo[] = $idproof;
        //dd($bedinfo);
        if($bedinfo){
            return response()->json(["message"=>"Bed found","bedinfo"=>$bedinfo]);
        }else{
            return response()->json(["message"=>"Sorry no such bed found","bedinfo"=>$bedinfo]);
        }
    }

    public function generateRegn(){
        $regcounterFile = storage_path('app/registrationcounter.txt');
        $regcounter = intval(file_get_contents($regcounterFile));
        $formattedCounter = sprintf('%04d', $regcounter);
        $prefix = "PATCON/" . date('d/m/Y/H/i/s') . "/";
        if($regcounter){
            $regn = $prefix.$formattedCounter;
            return $regn;
        }else{
            return response()->json(["message"=>"Sorry regestration number could not be generated"]);
        }
    }

    public function tokenGen($treat){
        $date =  date('Y-m-d');
        if($treat == "Surgery"){
            $scount = SurgeryCount::where('date',$date)->first();
            //dd($scount);
            if(!is_null($scount)){
                //dd(1);
                $countval = $scount->counter;
                //dd($countval);
                $countval = $countval + 1;
                $formattedtoken = sprintf('%02d', $countval);
                $token = "surg/".$formattedtoken;
                $upcount = $scount->update(["counter"=>$countval]);
            }else{
                //dd(0);
                $countval = 1;
                $formattedtoken = sprintf('%02d', $countval);
                $token = "surg/".$formattedtoken;
                $upcount = SurgeryCount::create(["counter"=>$countval,"date"=>$date]);
            }
            return $token;
        }else{
            $ocount = ObservationCount::where('date',$date)->first();
            if(!is_null($ocount)){
                $countval = $ocount->counter;
                $countval = $countval + 1;
                $formattedtoken = sprintf('%02d', $countval);
                $token = "obsrv/".$formattedtoken;
                $upcount = $ocount->update(["counter"=>$countval]);
            }else{
                $countval = 1;
                $formattedtoken = sprintf('%02d', $countval);
                $token = "obsrv/".$formattedtoken;
                $upcount = ObservationCount::create(["counter"=>$countval,"date"=>$date]);
            }
            return $token;
        }
    }

    public function getidproofLength($idproofID){
        //dd($idproofID);
        $idproofLength = IdProof::where('id',$idproofID)->value('id_val_length');
        //dd($idproofLength);
        if($idproofLength){
            return response()->json(['idproofLength'=>$idproofLength]);
        }
    }

    public function saveRegistration(Request $request){
        //dd($request->recordid);
        //dd($request);
        try{
            $request->validate([
                'bedno' => 'required',
                'bedname' => 'required',
                'type' => 'required',
                'pname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
                'phone' => ['required', 'digits_between:10,15'],
                'aname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
                'aphone' => ['required', 'digits_between:10,15']
            ]);
            if($request->recordid){
                //dd(1);
                $patientexist = Patient::where('id',$request->recordid)->first();
                $totalvisit = $patientexist->total_visits;
                $totalvisit = $totalvisit + 1;
                //dd($totalvisit);
                $updatepatientvisit = Patient::where('id',$request->recordid)->update(["total_visits"=>$totalvisit]);
                //dd($updatepatientvisit);
                if($updatepatientvisit){
                    $token = $this->tokenGen($request->treattype);
                    $flag = $request->emergency; 
                    if($flag == 1){
                        $flag = "Yes";
                    }else{
                        $flag = "No";
                    }
                    $regn = $patientexist->patient_regn_no;
                    $savetoken = Token::create([
                        'patient_regn_no'=>$regn,
                        'token_no'=>$token,
                        'attendant_name'=>ucwords($request->aname),
                        'attendant_phone'=>$request->aphone,
                        'bednumber'=>$request->bedno,
                        'type'=>$request->type,
                        'type_name'=>$request->typename,
                        'type_price_24hr'=>$request->price,
                        'date_of_addmission'=>Carbon::now()->toDateString(),
                        'time_of_addmission'=>Carbon::now()->toTimeString(),
                        'emergency'=>$flag,
                        'treating_type'=>$request->treattype,
                        'reffered_from'=>$request->reff,
                        'status'=>"Booked"
                    ]);
                    if($savetoken){
                        $updatebedstatus = BedAssign::where('bed_no',$request->bedno)->update(["status"=>"Booked"]);
                        if($updatebedstatus){
                            return response()->json(["message"=>"Booking completed successfully","regn"=>$regn]);
                        }else{
                            return response()->json(["message"=>"Sorry something went wrong"]);
                        }
                    }else{
                        return response()->json(["message"=>"Sorry something went wrong"]);
                    }

                 }
               
            }else{
                
                if($request->regno){
                    $regn = $request->regno;
                }else{
                    $regn = $this->generateRegn();
                }
                $savePatient = Patient::create([
                            'patient_regn_no'=>$regn,
                            'patient_name'=>ucwords($request->pname),
                            'patient_phone'=>$request->phone,
                            'patient_email'=>$request->email,
                            'idproof' => $request->idproof,
                            'idproof_no'=>$request->idproofno,
                            'patient_address'=>$request->address,
                            'total_visits'=>1
                        ]);
                if($savePatient){
                    $regcounterFile = storage_path('app/registrationcounter.txt');
                    $regcounter = intval(file_get_contents($regcounterFile));
                    $regcounter++;
                    file_put_contents($regcounterFile, $regcounter);
                    $token = $this->tokenGen($request->treattype);
                    //dd($token);
                    $flag = $request->emergency; 
                    if($flag == 1){
                        $flag = "Yes";
                    }else{
                        $flag = "No";
                    }
                    $savetoken = Token::create([
                        'patient_regn_no'=>$regn,
                        'token_no'=>$token,
                        'attendant_name'=>ucwords($request->aname),
                        'attendant_phone'=>$request->aphone,
                        'bednumber'=>$request->bedno,
                        'type'=>$request->type,
                        'type_name'=>$request->typename,
                        'type_price_24hr'=>$request->price,
                        'date_of_addmission'=>Carbon::now()->toDateString(),
                        'time_of_addmission'=>Carbon::now()->toTimeString(),
                        'emergency'=>$flag,
                        'treating_type'=>$request->treattype,
                        'reffered_from'=>$request->reff,
                        'status'=>"Booked"
                    ]);
                    if($savetoken){
                        $updatebedstatus = BedAssign::where('bed_no',$request->bedno)->update(["status"=>"Booked"]);
                        if($updatebedstatus){
                            return response()->json(["message"=>"Booking completed successfully","regn"=>$regn]);
                        }else{
                            return response()->json(["message"=>"Sorry something went wrong"]);
                        }
                    }else{
                        return response()->json(["message"=>"Sorry something went wrong"]);
                    }
                    
                }
            }
        }catch (ValidationException $e){
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function searchPatient($patid){
        //dd($patid);
        $patinfo = Patient::where('id',$patid)->first();
        if($patinfo){
            return response()->json(["message"=>"patient found","patinfo"=>$patinfo]);
        }else{
            return response()->json(["message"=>"Sorry something went wrong"]);
        }
    }

    public function getPatient($regn)
    {
        // Replace hyphens back with slashes
        $originalRegn = str_replace('-', '/', $regn);
        $currentDate = Carbon::now()->format('Y-m-d'); // Adjust the date format as needed

        $info = Token::with('patient')
            ->where('patient_regn_no', $originalRegn)
            ->where('date_of_addmission', $currentDate)
            ->first();
        //print_r($info);exit;
        return view("backend.visitorpass", ['info' => $info]);
    }


    // public function getPatient($regn)
    // {
    //     // Replace hyphens back with slashes
    //     $currentDate = Carbon::now()->format('Y-m-d');
    //     $originalRegn = str_replace('-', '/', $regn);
    //     $info = Token::with('patient')->where('patient_regn_no',$originalRegn)->where('date_of_addmission',$currentDate)->get();
    //     //dd($info);
    //     if($info){
    //         return view("backend.visitorpass",['info'=>$info]);
    //     }
        
    // }
}
