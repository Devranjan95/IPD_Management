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
use App\Models\BirthRecord;
use App\Models\NewBorn;


class StatusController extends Controller
{
    public function index(){
        $statusArray = ["Booked","InBed"];
        // $regns = Token::whereIn('status', $statusArray)
        //         ->where(function ($query) {
        //             $query->where('deceased_status', '!=', 'Y')
        //                 ->orWhereNull('deceased_status');
        //         })
        //         ->select('patient_regn_no')
        //         ->get();
        $regns = Token::whereIn('status',$statusArray)->orderBy('patient_regn_no', 'desc')->select('patient_regn_no')->get();
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
        //dd($patientInfo->tokens->pluck('deceased_status'));
        return response()->json(["message"=>"Load patient details","patientInfo"=>$patientInfo]);
        //dd($patientInfo);
    }

    public function updateStatus(Request $request){
        //dd($request->tokenId);
        $regn = Token::where('id',$request->tokenId)->select('patient_regn_no')->first();
        //dd($regn);
        $updateToken = Token::where('id',$request->tokenId)->update(['deceased_status'=>'Y']);
        $updatePatient = Patient::where('patient_regn_no',$regn->patient_regn_no)->update(['deceased_status'=>'Y']);
       
        if($updateToken){
            return response()->json(["status"=>true,"message"=>"Patient marked as deceased"]);
        }else{
            return response()->json(["status"=>false,"message"=>"Something went wrong"]);
        }
    }

    // public function updateStatusNewBorn(Request $request){
    //     //dd($request);
    //     $updateToken = Token::where('id',$request->tokenId)->update(['maternity_status'=>'Successfull']);
    //     if($updateToken){
    //         return response()->json(["status"=>true,"message"=>"Labour delivery successfull"]);
    //     }else{
    //         return response()->json(["status"=>false,"message"=>"Sorry something went wrong"]);
    //     }
    // }

    public function updateStatusNewBorn($id){
        dd($id);
        $token = Token::with('patient')->find($id);
        //dd($token->maternity_status);
        $tokenInfo = Token::where('id',$id)->first();
        if($token){
            return response()->json(["status"=>true,"token"=>$token,"tokenInfo" => $tokenInfo]);
        }
        
    }

    // public function saveBirth(Request $request){
    //     //dd($request);
    //     dd($request->file('imgfile'));
    //     $rules = [
    //         'recordid' => 'nullable|integer',
    //         'regnno' => 'required|string',
    //         'patname' => 'required|string',
    //         'contact' => 'required|digits:10',
    //         'fatheradhar' => 'required|digits:12',
    //         'motheradhar' => 'required|digits:12',
    //         'fathername' => 'required|string',
    //         'address' => 'required|string',
    //         'maritalstatus' => 'required|in:Single,Married,Widowed,Divorced',
    //         'issuedby' => 'required|string',
    //         'imgfile.*' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp,svg', // Adjust the image validation as needed
    //         'repeatCount' => 'required|integer|min:1',
    //         'birthdate_*' => 'required|date',
    //         'birthtime_*' => 'required|date_format:H:i',
    //         'placeofbirth_*' => 'required|string',
    //         'gender_*' => 'required|in:Male,Female,Other',
    //         'weight_*' => 'required|numeric|min:0',
    //         'length_*' => 'required|numeric|min:0',
    //     ];

    //     // Validate the request
    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => false, 'message' => $validator->errors()->first()], 400);
    //     }

    //     try {
    //         // Save the birth record
    //         $birthRecord = $request->recordid ? BirthRecord::find($request->recordid) : new BirthRecord;

    //         $birthRecord->recordid = $request->recordid;
    //         $birthRecord->regn = $request->regnno;
    //         $birthRecord->patname = $request->patname;
    //         $birthRecord->contact = $request->contact;
    //         $birthRecord->addmission_date = $request->addmissiondate;
    //         $birthRecord->addmission_time = $request->addmissiontime;
    //         $birthRecord->fathername = $request->fathername;
    //         $birthRecord->mothername = $request->patname;
    //         $birthRecord->fatheradhar = $request->fatheradhar;
    //         $birthRecord->motheradhar = $request->motheradhar;
    //         $birthRecord->address = $request->address;
    //         $birthRecord->maritalstatus = $request->maritalstatus;
    //         $birthRecord->issuedby = $request->issuedby;

           
    //         $birthRecord->save();
    //         $updateToken = Token::where('patient_regn_no',$request->regnno)
    //                               ->where('date_of_addmission',$request->addmissiondate)
    //                               ->where('time_of_addmission',$request->addmissiontime)
    //                               ->update(["maternity_status"=>"Successful-R"]);
            
    //         // Save multiple new born entries
    //         $repeatCount = $request->input('repeatCount', 1);
    //         for ($i = 0; $i < $repeatCount; $i++) {
    //             $newBorn = new NewBorn(); // Use NewBorn model for newborn entries
    //             $newBorn->birth_record_id = $birthRecord->id;
    //             $newBorn->birthdate = $request->input("birthdate_$i");
    //             $newBorn->birthtime = $request->input("birthtime_$i");
    //             $newBorn->placeofbirth = $request->input("placeofbirth_$i");
    //             $newBorn->gender = $request->input("gender_$i");
    //             $newBorn->weight = $request->input("weight_$i");
    //             $newBorn->length = $request->input("length_$i");
                
    //             if ($request->hasFile('imgfile')) {
    //                 $image = $request->file('imgfile');
    //                 $extension = $image->getClientOriginalExtension();
    //                 $filename = 'img_' . time() . '.' . $extension;
    //                 $path = $image->storeAs('assets/birth', $filename, 'public');
    //                 // Store the relative path for use in your application
    //                 $newBorn->image_path = 'storage/' . $path;
    //             }
    //             $newBorn->save();
    //         }

    //         $tokInfo = Token::where('patient_regn_no',$request->regnno)
    //                         ->where('date_of_addmission',$request->addmissiondate)
    //                         ->where('time_of_addmission',$request->addmissiontime)
    //                         ->first();
    //         return response()->json(['status' => true, 'message' => 'Birth record saved successfully.','tokInfo'=>$tokInfo]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'An error occurred while saving the birth record.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function saveBirth(Request $request)
    {
        $rules = [
            // ... other validation rules ...
            'imgfile.*' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp,svg',
            'repeatCount' => 'required|integer|min:1',
            'birthdate_*' => 'required|date',
            'birthtime_*' => 'required|date_format:H:i',
            'placeofbirth_*' => 'required|string',
            'gender_*' => 'required|in:Male,Female,Other',
            'weight_*' => 'required|numeric|min:0',
            'length_*' => 'required|numeric|min:0',
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 400);
        }
    
        try {
            // Save the birth record
            $birthRecord = $request->recordid ? BirthRecord::find($request->recordid) : new BirthRecord;
    
            $birthRecord->recordid = $request->recordid;
            $birthRecord->regn = $request->regnno;
            $birthRecord->patname = $request->patname;
            $birthRecord->contact = $request->contact;
            $birthRecord->addmission_date = $request->addmissiondate;
            $birthRecord->addmission_time = $request->addmissiontime;
            $birthRecord->fathername = $request->fathername;
            $birthRecord->mothername = $request->patname;
            $birthRecord->fatheradhar = $request->fatheradhar;
            $birthRecord->motheradhar = $request->motheradhar;
            $birthRecord->address = $request->address;
            $birthRecord->maritalstatus = $request->maritalstatus;
            $birthRecord->issuedby = $request->issuedby;
    
            $birthRecord->save();
    
            $updateToken = Token::where('patient_regn_no', $request->regnno)
                ->where('date_of_addmission', $request->addmissiondate)
                ->where('time_of_addmission', $request->addmissiontime)
                ->update(["maternity_status" => "Successful-R"]);
    
            // Save multiple new born entries
            $repeatCount = $request->input('repeatCount', 1);
            $x = [];
            for ($i = 0; $i < $repeatCount; $i++) {
                $newBorn = new NewBorn();
                $newBorn->birth_record_id = $birthRecord->id;
                $newBorn->birthdate = $request->input("birthdate_$i");
                $newBorn->birthtime = $request->input("birthtime_$i");
                $newBorn->placeofbirth = $request->input("placeofbirth_$i");
                $newBorn->gender = $request->input("gender_$i");
                $newBorn->weight = $request->input("weight_$i");
                $newBorn->length = $request->input("length_$i");
                
                // Handle image upload
                if ($request->hasFile("imgfile_$i")) {
                    //dd(1);
                    $image = $request->file("imgfile_$i");
                    $extension = $image->getClientOriginalExtension();
                    $filename = 'img_' . time() . '_' . $i . '.' . $extension;
                    $path = $image->storeAs('assets/birth', $filename, 'public');
                    //$x[] = $path;
                    $newBorn->image_path = 'storage/' . $path;
                    $newBorn->save();
                }
                //dd($x);
                //$newBorn->save();
            }
          
    
            $tokInfo = Token::where('patient_regn_no', $request->regnno)
                ->where('date_of_addmission', $request->addmissiondate)
                ->where('time_of_addmission', $request->addmissiontime)
                ->first();
    
            return response()->json(['status' => true, 'message' => 'Birth record saved successfully!', 'token_info' => $tokInfo]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
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
