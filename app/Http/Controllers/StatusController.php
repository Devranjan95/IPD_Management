<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Token;
use App\Models\DeathRecord;
use App\Models\DischargeInfo;


class StatusController extends Controller
{
    public function index(){
        $regns = Token::where('status', 'Booked')
                ->where(function ($query) {
                    $query->where('deceased_status', '!=', 'Y')
                        ->orWhereNull('deceased_status');
                })
                ->select('patient_regn_no')
                ->get();
        //dd($regns);
        return view('backend.Discharge.patientstatusupdate',['regns'=>$regns]);
    }

    public function searchPatient(Request $request){
        //dd($request);
        $statusArray = ["Booked","InBed"];
        // Fetch the patient with filtered tokens
        $patientInfo = Patient::with(['tokens' => function($query) use ($statusArray) {
            $query->whereIn('status', $statusArray);
        }])->where('patient_regn_no', $request->regn)->first();
        
        return response()->json(["message"=>"Load patient details","patientInfo"=>$patientInfo]);
        //dd($patientInfo);
    }

    public function updateStatus(Request $request){
        $updateToken = Token::where('id',$request->tokenId)->update(['deceased_status'=>'Y']);
        if($updateToken){
            return response()->json(["status"=>true,"message"=>"Patient marked as deceased"]);
        }else{
            return response()->json(["status"=>false,"message"=>"Something went wrong"]);
        }
    }

    public function updateStatusNewBorn(Request $request){
        //dd($request);
        $updateToken = Token::where('id',$request->tokenId)->update(['maternity_status'=>'Successfull']);
        if($updateToken){
            return response()->json(["status"=>true,"message"=>"Labour delivery successfull"]);
        }else{
            return response()->json(["status"=>false,"message"=>"Sorry something went wrong"]);
        }
    }

    public function updateStatusNewDischargeProcess(Request $request){
        $updateToken = Token::where('id',$request->tokenId)->update(['status'=>'Clear for Discharge']);
        if($updateToken){
            return response()->json(["status"=>true,"message"=>"Discharge process starts"]);
        }else{
            return response()->json(["status"=>false,"message"=>"Sorry something went wrong"]);
        }
    }
}
