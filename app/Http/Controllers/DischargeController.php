<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Token;
use App\Models\DischargeInfo;
use App\Models\BedAssign;


class DischargeController extends Controller
{
    //
    public function index(){
        //$statusArray = ["Booked","InBed","Operation"];
        $statusArray = ["Clear for Discharge"];
        $regnvalues = Token::whereIn('status',$statusArray)->select('patient_regn_no')->get();
        return view('backend.Discharge.dischargeform',['regnvalues'=>$regnvalues]);
    }

    public function searchPatient(Request $request){
        $statusArray = ["Booked","InBed","Operation"];
        //dd($request);
        $patientinfo = Patient::where('patient_regn_no',$request->regn)->first();
        //$tokeninfo = Token::where('patient_regn_no',$request->regn)->whereIn('status',$statusArray)->first();
        //dd($tokeninfo);
        //$advancePaid = $tokeninfo->adv_amount;
        
        if($patientinfo){
            return response()->json(["status"=>true,"message"=>"Patient found","patientinfo"=>$patientinfo]);
        }else{
            return response()->json(["status"=>false,"message"=>"Patient not found"]);
        }
    }

    public function finalDischarge(Request $request){
        $regns = Token::where('status','Discharge InProgress')->get();
        return view('backend.Discharge.finaldischarge',['regns'=>$regns]);
       
    }

    public function searchDischargeInprogress(Request $request){
        //dd($request);
        $statusArray = ["Booked","InBed","Discharge InProgress"];
        // Fetch the patient with filtered tokens
        $patientInfo = Patient::with(['tokens' => function($query) use ($statusArray) {
            $query->whereIn('status', $statusArray);
        }])->where('patient_regn_no', $request->regn)->first();
        
        return response()->json(["message"=>"Load patient details","patientInfo"=>$patientInfo]);
    }

    public function updateDischarge(Request $request){
        //dd($request);
        $tokeninfo = Token::where('id',$request->tokenId)->first();
        //dd($tokeninfo);
        $tokenUpdate = Token::where('id',$request->tokenId)->update(["status"=>"Discharged"]);
        if($tokenUpdate){
            $bedupdate = BedAssign::where('bed_no',$tokeninfo->bednumber)->update(["status"=>"Vacant"]);
            return response()->json(["status"=>true,"message"=>"Checkout Successful"]);
        }else{
            return response()->json(["status"=>false,"message"=>"Checkout Unsuccessful"]);
        }
        

        
    }

    

    // public function saveDischarge(Request $request)
    // {
    //     //dd($request->contact);
    //      try {
    //         // Validate input data
    //         $request->validate([
    //             'patname' => 'required|string|max:255',
    //             'contact' => 'required',
    //             'disdate' => 'required|date',
    //             'distime' => 'required|date_format:H:i',
    //             'pstatus' => 'required|string',
    //             'regn' => 'required|string',
    //             'native-select' => 'required' // validate this field later
    //         ]);
    
    //         // Retrieve and clean the 'native-select' field
    //         $clearance = $request->input('native-select');
    //         if (is_string($clearance)) {
    //             $clearance = explode(',', $clearance); // Convert comma-separated string to array
    //         }
    
    //         if (empty($clearance)) {
    //             return response()->json(["status" => false, "message" => "Error!! Please select clearance"]);
    //         }

    //         // Create new discharge entry
    //         $saveDischarge = DischargeInfo::create([
    //             'patient_regn_no' => $request->regn,
    //             'patient_name' => $request->patname,
    //             'contact' => $request->contact,
    //             'clearance' => json_encode($clearance), // Store as JSON
    //             'patient_status' => $request->pstatus,
    //             'date_of_discharge' => $request->disdate,
    //             'time_of_discharge' => $request->distime,
    //             'discharge_summary' => $request->summary
    //         ]);
    
    //         // Update token status
    //         if ($saveDischarge) {
    //             $updateDatetoken = Token::where('patient_regn_no', $request->regn)
    //                 ->where('status', 'InBed')
    //                 ->update([
    //                     'date_of_discharge' => $request->disdate,
    //                     'time_of_discharge' => $request->distime,
    //                     'status' => 'Discharge InProgress'
    //                 ]);
    
    //             if ($updateDatetoken) {
    //                 $tokenVal = Token::where('patient_regn_no',$request->regn)->where('status','Discharge InProgress')->first();
    //                 $price24hrs = $tokenVal->type_price_24hr;
    //                 $timeOfAdmission = $tokenVal->time_of_addmission;
    //                 $timeOfDischarge = $tokenVal->time_of_discharge;
    //                 dd($timeOfAdmission);
    //                 dd($timeOfDischarge);
    //                 $admissionTime = Carbon::createFromFormat('H:i', $timeOfAdmission); //showing error from here
    //                 $dischargeTime = Carbon::createFromFormat('H:i', $timeOfDischarge);
    //                 dd($timeOfAdmission);
    //                 dd($timeOfDischarge);
    //                 $hoursDifference = $admissionTime->diffInHours($dischargeTime);
    //                 dd($hoursDifference);
    //                 $advance = $token->adv_amount;
    //                 return response()->json(["status" => true, "message" => "Ready to discharge"]);
    //             } else {
    //                 return response()->json(["status" => false, "message" => "Sorry, something went wrong during token update"]);
    //             }
    //         } else {
    //             return response()->json(["status" => false, "message" => "Sorry, something went wrong during discharge creation"]);
    //         }
    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $e->errors()
    //         ], 422);
    //     }
    // }

 



    public function saveDischarge(Request $request)
    {
        //dd($request);
        try {
            $clearance = $request->input('native-select');
            if (is_string($clearance)) {
                $clearance = explode(',', $clearance); // Convert comma-separated string to array
            }
    
            if (empty($clearance)) {
                return response()->json(["status" => false, "message" => "Error!! Please select clearance"]);
            }elseif(count($clearance) != 4){
                return response()->json(["status" => false, "message" => "Error!! Current patient do not have all clearance"]);
            }
            // Validate input data
            $request->validate([
                'patname' => 'required|string|max:255',
                'contact' => 'required',
                'disdate' => 'required|date',
                'distime' => 'required|date_format:H:i',
                'pstatus' => 'required|string',
                'regn' => 'required|string',
                'native-select' => 'required' // validate this field later
            ]);
    
            // Retrieve and clean the 'native-select' field
           
            //dd($request->summary);
            // Create new discharge entry
            $saveDischarge = DischargeInfo::create([
                'patient_regn_no' => $request->regn,
                'patient_name' => $request->patname,
                'contact' => $request->contact,
                'clearance' => json_encode($clearance), // Store as JSON
                'patient_status' => $request->pstatus,
                'date_of_discharge' => $request->disdate,
                'time_of_discharge' => $request->distime,
                'discharge_summary' => $request->summary
            ]);
    
            // Update token status
            if ($saveDischarge) {
                $statusArray = ["Clear for Discharge"];
                $updateDatetoken = Token::where('patient_regn_no', $request->regn)
                    ->whereIn('status', $statusArray)
                    ->update([
                        'date_of_discharge' => $request->disdate,
                        'time_of_discharge' => $request->distime,
                        'status' => 'Discharge InProgress'
                    ]);
    
                if ($updateDatetoken) {
                    //dd(1);
                    $tokenVal = Token::where('patient_regn_no', $request->regn)->where('status', 'Discharge InProgress')->first();
                    $price24hrs = $tokenVal->type_price_24hr;
                    //dd($price24hrs);
                    $dateOfAdmission = $tokenVal->date_of_addmission;
                    $timeOfAdmission = $tokenVal->time_of_addmission;
                    $dateOfDischarge = $tokenVal->date_of_discharge;
                    $timeOfDischarge = $tokenVal->time_of_discharge;
    
                    // Combine date and time strings to create full datetime strings
                    $admissionDateTime = Carbon::createFromFormat('Y-m-d H:i', $dateOfAdmission . ' ' . $timeOfAdmission);
        
                    //dd($admissionDateTime);
                    $dischargeDateTime = Carbon::createFromFormat('Y-m-d H:i', $dateOfDischarge . ' ' . $timeOfDischarge);
                    //dd($dischargeDateTime);
                    // Calculate the difference in hours
                    $hoursDifference = $admissionDateTime->diffInHours($dischargeDateTime);
                    //dd($hoursDifference);
                    $MultiplyVal = $hoursDifference/24 ;
                    $totalPrice = number_format($price24hrs * $MultiplyVal,2);
                    $advance = $tokenVal->adv_amount;
                    //dd($totalPrice);

                    $updatePrice = Token::where('patient_regn_no', $request->regn)
                                        ->where('status', 'Discharge InProgress')
                                        ->update(['total_stay_hr'=>$hoursDifference,'total_price'=>$totalPrice]);
                    if( $updatePrice){
                        return response()->json(["status" => true, "message" => "Ready to discharge"]);
                    }

                } else {
                    return response()->json(["status" => false, "message" => "Sorry, something went wrong during token update"]);
                }
            } else {
                return response()->json(["status" => false, "message" => "Sorry, something went wrong during discharge creation"]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    





    
}
