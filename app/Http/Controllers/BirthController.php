<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Token;
use App\Models\BirthRecord;


class BirthController extends Controller
{
    public function index(){
        $statusArray = ["Booked","InBed","Operation","BabyBorn"];
        $regnvalues = Token::whereIn('status',$statusArray)->select('patient_regn_no')->get();
        return view("backend.Discharge.birthrecordentry",["regnvalues"=>$regnvalues]);
    }

    public function searchPatient(Request $request){
        $statusArray = ["Booked","InBed","Operation","BabyBorn"];
        $patientInfo = Patient::where('patient_regn_no',$request->regn)->first();
        //$tokenInfo = Token::where('patient_regn_no',$request->regn)->whereIn('status',$statusArray)->first();
        return response()->json(["message"=>"Patient found","patientInfo"=>$patientInfo]);
    }

    public function saveBirthRecord(Request $request)
    {
        // Debug incoming request data
        // dd($request->all());
    
        // Define validation rules
        $rules = [
            'recordid' => 'nullable|integer',
            'regn' => 'required|string',
            'patname' => 'required|string',
            'contact' => 'required|digits:10',
            'fatheradhar' => 'required|digits:12',
            'motheradhar' => 'required|digits:12',
            'fathername' => 'required|string',
            'mothername' => 'required|string',
            'birthdate' => 'required|date',
            'birthtime' => 'required|date_format:H:i',
            'placeofbirth' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'weight' => 'required|numeric|min:0',
            'length' => 'required|numeric|min:0',
            'address' => 'required|string',
            'maritalstatus' => 'required|in:Single,Married,Widowed,Divorced',
            'issuedby' => 'required|string',
            'imgfile' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp,svg' // Adjust the image validation as needed
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 400);
        }
    
        try {
            // Save or update the birth record
            $birthRecord = $request->recordid ? BirthRecord::find($request->recordid) : new BirthRecord;
    
            $birthRecord->recordid = $request->recordid;
            $birthRecord->regn = $request->regn;
            $birthRecord->patname = $request->patname;
            $birthRecord->contact = $request->contact;
            $birthRecord->birthdate = $request->birthdate;
            $birthRecord->birthtime = $request->birthtime;
            $birthRecord->placeofbirth = $request->placeofbirth;
            $birthRecord->gender = $request->gender;
            $birthRecord->weight = $request->weight;
            $birthRecord->length = $request->length;
            $birthRecord->fathername = $request->fathername;
            $birthRecord->mothername = $request->mothername;
            $birthRecord->fatheradhar = $request->fatheradhar;
            $birthRecord->motheradhar = $request->motheradhar;
            $birthRecord->address = $request->address;
            $birthRecord->maritalstatus = $request->maritalstatus;
            $birthRecord->issuedby = $request->issuedby;
    
            if ($request->hasFile('imgfile')) {
                $image = $request->file('imgfile');
                $filename = 'img_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('assets/birth', $filename, 'public');
                $birthRecord->image_path = 'storage/' . $path;
            }
    
            $birthRecord->save();
    
            // Debug to ensure this line is reached
           // dd(1);
    
            return response()->json(['status' => true, 'message' => 'Birth record saved successfully.']);
    
        } catch (\Exception $e) {
            // Debug the exception message
            //dd($e->getMessage());
    
            return response()->json(['status' => false, 'message' => 'An error occurred while saving the birth record.'], 500);
        }
    }
    
    
}
