<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Amenity;
use App\Models\Cabin;
use App\Models\CabinType;
use App\Models\WardType;
use App\Models\IcuType;
use App\Models\Ward;
use App\Models\Icu;
use App\Models\Bed;
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
                $bedassigninfo = BedAssign::where('block_id', $blk->id)->select('bed_no', 'type', 'status','type_id','category','bed_price')->get();
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
        return view('backend.Registration.registration', ['floor' => $floors, 'floorOccupancy' => $floorOccupancy]);
    }
    

    public function getBedData($bednum){
        $bednum = str_replace('-', '/', $bednum);
        $regnNos = Patient::where('deceased_status',null)->pluck('patient_regn_no','id');
        //dd($regnNos);
        //$regnNos = Token::where('deceased_status','!=','Y')->pluck('patient_regn_no','id');
        //dd($bednum);
        $beddata = BedAssign::where('bed_no',$bednum)->first();
        $bedname = Bed::where('id',$beddata->bed_name)->value('bed_name');
        $floor = Floor::where('count',$beddata->floor_count)->select('floor_no','count')->first();
        $block = Block::where('id',$beddata->block_id)->select('block_name','id')->first();
        $idproof = IdProof::where('status','Active')->pluck('id_name','id');
        $amenities = Amenity::where('status','Active')->pluck('amenities','id');
        $amvals = [];
        if($beddata->type == "cabin"){
            $cabininfo = Cabin::where('id',$beddata->type_id)->first();
            $type = CabinType::where('id',$cabininfo->cabin_type_id)->value('cabin_type');
            $amenityvals = $cabininfo->amenities;
            $amenityvals = explode(',',$amenityvals);
            foreach($amenityvals as $key=>$val){
                $amenitycompare = Amenity::where('id',$val)->pluck('amenities','id');
                $amvals[]=$amenitycompare;
            }
            //dd($amvals);
            //$type = $cabininfo->cabin_type_id;
            $bedinfo = [$beddata,$floor,$block,$cabininfo,$type];
        }elseif($beddata->type == "ward"){
            $wardinfo = Ward::where('id',$beddata->type_id)->first();
            $type = WardType::where('id',$wardinfo->ward_type_id)->value('ward_type');
            $amenityvals = $wardinfo->amenities;
            $amenityvals = explode(',',$amenityvals);
            foreach($amenityvals as $key=>$val){
                $amenitycompare = Amenity::where('id',$val)->pluck('amenities','id');
                $amvals[]=$amenitycompare;
            }
            //$type = $wardinfo->ward_type_id;
            $bedinfo = [$beddata,$floor,$block,$wardinfo,$type];
        }else{
            $icuinfo = Icu::where('id',$beddata->type_id)->first();
            $type = IcuType::where('id',$icuinfo->icu_type_id)->value('icu_type');
            $amenityvals = $icuinfo->amenities;
            $amenityvals = explode(',',$amenityvals);
            foreach($amenityvals as $key=>$val){
                $amenitycompare = Amenity::where('id',$val)->pluck('amenities','id');
                $amvals[]=$amenitycompare;
            }
            //$type = $icuinfo->icu_type_id;
            $bedinfo = [$beddata,$floor,$block,$icuinfo,$type];
        }
        $bedinfo[] = $regnNos;
        $bedinfo[] = $idproof;
        $bedinfo[] = $bedname;
        $bedinfo[] = $amenities;
        $bedinfo[] = $amvals;
        //dd($bedinfo);
        //print_r($bedinfo);

        //exit;
        if($bedinfo){
            return response()->json(["message"=>"Bed found","bedinfo"=>$bedinfo]);
        }else{
            return response()->json(["message"=>"Sorry no such bed found","bedinfo"=>$bedinfo]);
        }
    }

    
    

    public function generateRegn(){
        //dd(1);
        $regcounterFile = storage_path('app/registrationcounter.txt');
        $regcounter = intval(file_get_contents($regcounterFile));
        //dd($regcounter);
        $formattedCounter = sprintf('%04d', $regcounter);
        $prefix = "PATCON/" . date('d/m/Y/H/i/s') . "/";
        if($regcounter){
            //dd(1);
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

    public function getAmenityCost(Request $request){
        $amenityIds = $request->selectedAmenities;
        $totalCost = 0;
    
        if($request->type == "cabin"){
            $cabinCost = Cabin::where('status', 'Active')->where('id', $request->typeid)->value('price');
            $totalCost = $cabinCost;
    
            if (!empty($amenityIds)) {
                $amenityPrices = [];
                foreach($amenityIds as $id) {
                    $amenitycost = Amenity::where('status', 'Active')->where('id', $id)->value('price');
                    $amenityPrices[] = $amenitycost;
                }
    
                $amenityCostsum = array_sum($amenityPrices);
                $totalCost += $amenityCostsum;
            }
            
        } elseif($request->type == "ward") {
            $wardCost = Ward::where('status', 'Active')->where('id', $request->typeid)->value('price');
            $totalCost = $wardCost;
    
            if (!empty($amenityIds)) {
                $amenityPrices = [];
                foreach($amenityIds as $id) {
                    $amenitycost = Amenity::where('status', 'Active')->where('id', $id)->value('price');
                    $amenityPrices[] = $amenitycost;
                }
    
                $amenityCostsum = array_sum($amenityPrices);
                $totalCost += $amenityCostsum;
            }
            
        } elseif($request->type == "icu") {
            $icuCost = Icu::where('status', 'Active')->where('id', $request->typeid)->value('price');
            $totalCost = $icuCost;
    
            if (!empty($amenityIds)) {
                $amenityPrices = [];
                foreach($amenityIds as $id) {
                    $amenitycost = Amenity::where('status', 'Active')->where('id', $id)->value('price');
                    $amenityPrices[] = $amenitycost;
                }
    
                $amenityCostsum = array_sum($amenityPrices);
                $totalCost += $amenityCostsum;
            }
            
        } else {
            return response()->json(["message" => "Invalid type!"]);
        }
    
        return response()->json(["totalCost" => $totalCost]);
    }
    

    public function saveRegistration(Request $request) {
        //dd($request->all()); // Debug all input data
        //dd($request->totalcost);
        //dd($request->recordid);
        //dd($request->floorcount);
        //dd($request->blockid);
        try {
            $request->validate([
                'bedno' => 'required',
                'bedname' => 'required',
                'pname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
                'phone' => ['required', 'digits_between:10,15'],
                'aname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
                'aphone' => ['required', 'digits_between:10,15']
            ]);
    
            if ($request->recordid) {
                //$patexist = Token::where('')
                //dd(1);
                $patientexist = Patient::where('id', $request->recordid)->first();
                $token = Token::where("patient_regn_no",$patientexist->patient_regn_no)->where('status','Booked')->first();
                //dd($token);
                if($token){
                    return response()->json(["status"=>false,"message"=>"Sorry this patient is already booked"]);
                }else{
                    if(!empty($request->amenities)){
                        $amenities = implode(',',$request->amenities);
                        $amenitydate = Carbon::now()->toDateString();
                    }else{
                        $amenities = null;
                        $amenitydate = null;
                    }
                    $totalvisit = $patientexist->total_visits + 1;
                    $updatepatientvisit = Patient::where('id', $request->recordid)->update(["total_visits" => $totalvisit]);
        
                    if ($updatepatientvisit) {
                        $token = $this->tokenGen($request->treattype);
                        $flag = $request->emergency ? "Yes" : "No";
                        $regn = $patientexist->patient_regn_no;
                        $savetoken = Token::create([
                            'patient_regn_no' => $regn,
                            'token_no' => $token,
                            'attendant_name' => ucwords($request->aname),
                            'attendant_phone' => $request->aphone,
                            'bednumber' => $request->bedno,
                            'bedtype' => $request->bedname,
                            'flag' => $request->flag, // Ensure this is set correctly
                            'category_id' => $request->catid, // Ensure this is set correctly
                            'type_name_id' => $request->typeid, // Ensure this is set correctly
                            'floor_count' => $request->floorcount,
                            'block_id' => $request->blockid,
                            'extra_amenity'=>$amenities,
                            'amenity_start_date'=>$amenitydate,
                            'type_price_24hr' => $request->totalcost,
                            'adv_amount'=>$request->advance,
                            'date_of_addmission' => Carbon::now()->toDateString(),
                            'time_of_addmission' => Carbon::now()->format('H:i'),
                            'emergency' => $flag,
                            'treating_type' => $request->treattype,
                            'reffered_from' => $request->reff,
                            'status' => "Booked"
                        ]);
        
                        if ($savetoken) {
                            $updatebedstatus = BedAssign::where('bed_no', $request->bedno)->update(["status" => "Booked"]);
                            if ($updatebedstatus) {
                                return response()->json(["status"=>true,"message" => "Booking completed successfully", "regn" => $regn]);
                            } else {
                                return response()->json(["status"=>false,"message" => "Sorry something went wrong"]);
                            }
                        } else {
                            return response()->json(["status"=>false,"message" => "Sorry something went wrong"]);
                        }
                    }
                }
                
            } else {
                //dd($request->regno);

                if ($request->has('regno') && !empty($request->regno)) {
                    $regn = $request->regno;
                } else {
                    $regn = $this->generateRegn();
                }
                
                //print_r($regn);exit;
                $savePatient = Patient::create([
                    'patient_regn_no' => $regn,
                    'patient_name' => ucwords($request->pname),
                    'patient_phone' => $request->phone,
                    'patient_email' => $request->email,
                    'idproof' => $request->idproof,
                    'idproof_no' => $request->idproofno,
                    'patient_address' => $request->address,
                    'total_visits' => 1
                ]);
    
                if ($savePatient) {
                    $regcounterFile = storage_path('app/registrationcounter.txt');
                    $regcounter = intval(file_get_contents($regcounterFile));
                    $regcounter++;
                    file_put_contents($regcounterFile, $regcounter);
                    $token = $this->tokenGen($request->treattype);
                    $flag = $request->emergency ? "Yes" : "No";

                    if(!empty($request->amenities)){
                        $amenities = implode(',',$request->amenities);
                        $amenitydate = Carbon::now()->toDateString();
                    }else{
                        $amenities = null;
                        $amenitydate = null;
                    }
    
                    $savetoken = Token::create([
                        'patient_regn_no' => $regn,
                        'token_no' => $token,
                        'attendant_name' => ucwords($request->aname),
                        'attendant_phone' => $request->aphone,
                        'bednumber' => $request->bedno,
                        'bedtype' => $request->bedname,
                        'flag' => $request->flag, // Ensure this is set correctly
                        'category_id' => $request->catid, // Ensure this is set correctly
                        'type_name_id' => $request->typeid, // Ensure this is set correctly
                        'floor_count' => $request->floorcount,
                        'block_id' => $request->blockid,
                        'extra_amenity'=>$amenities,
                        'amenity_start_date'=>$amenitydate,
                        'type_price_24hr' => $request->totalcost,
                        'adv_amount'=>$request->advance,
                        'date_of_addmission' => Carbon::now()->toDateString(),
                        'time_of_addmission' => Carbon::now()->format('H:i'),
                        'emergency' => $flag,
                        'treating_type' => $request->treattype,
                        'reffered_from' => $request->reff,
                        'status' => "Booked"
                    ]);
    
                    if ($savetoken) {
                        $updatebedstatus = BedAssign::where('bed_no', $request->bedno)->update(["status" => "Booked"]);
                        if ($updatebedstatus) {
                            return response()->json(["status"=>true,"message" => "Booking completed successfully", "regn" => $regn]);
                        } else {
                            return response()->json(["status"=>false,"message" => "Sorry something went wrong"]);
                        }
                    } else {
                        return response()->json(["status"=>false,"message" => "Sorry something went wrong"]);
                    }
                }
            }
        } catch (ValidationException $e) {
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
        $currentTime = Carbon::now()->format('H:i');
        //dd($currentTime);
        $info = Token::with('patient')
            ->where('patient_regn_no', $originalRegn)
            ->where('date_of_addmission', $currentDate)
            ->where('time_of_addmission', $currentTime)
            ->first();
            //dd($info);
        //print_r($info);exit;

        return view("backend.Registration.visitorpass", ['info' => $info]);
    }



}
