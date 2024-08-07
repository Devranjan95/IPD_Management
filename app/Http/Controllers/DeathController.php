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


class DeathController extends Controller
{
    public function index(){
        //$statusArray = ["Deceased"];
        $regnvalues = Token::where('deceased_status','Y')->select('patient_regn_no')->get();
        return view("backend.Discharge.deathrecordentry",["regnvalues"=>$regnvalues]);
    }

    public function searchPatient(Request $request){
        $patientInfo = Patient::where('patient_regn_no',$request->regn)->first();
        $tokenInfo = Token::where('patient_regn_no',$request->regn)->where('deceased_status','Y')->first();
        return response()->json(["message"=>"Patient found","patientInfo"=>$patientInfo,"tokenInfo"=>$tokenInfo]);
    }

    
    public function saveDeathRecord(Request $request)
    {
        // Define validation rules
        $rules = [
            'regn' => 'required|string',
            'patname' => 'required|string',
            'contact' => 'required|digits:10',
            'adhr' => 'required|digits:12',
            'aname' => 'required|string',
            'deathdate' => 'required|date',
            'deathtime' => 'required|date_format:H:i',
            'placeofdeath' => 'required|string',
            'causeofdeath' => 'required|string',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required|string',
            'maritalstatus' => 'required|in:Single,Married,Widowed,Divorced',
            'fathername' => 'required|string',
            'mothername' => 'required|string',
            'issuedby' => 'required|string',
            'imgfile' => 'required|image|max:28|mimes:jpg,jpeg,png,webp,svg'
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 400);
        }
    
        try {
            // Save or update the death record
            $deathRecord = $request->recordid ? DeathRecord::find($request->recordid) : new DeathRecord;
    
            $deathRecord->patient_regn_no = $request->regn;
            $deathRecord->patient_name = $request->patname;
            $deathRecord->contact_no = $request->contact;
            $deathRecord->adhr_no = $request->adhr;
            $deathRecord->attendant_name = $request->aname;
            $deathRecord->date_of_addmission = $request->addmissiondate;
            $deathRecord->time_of_addmission = $request->addmissiontime;
            $deathRecord->date_of_death = $request->deathdate;
            $deathRecord->time_of_death = $request->deathtime;
            $deathRecord->place_of_death = $request->placeofdeath;
            $deathRecord->cause_of_death = $request->causeofdeath;
            $deathRecord->age = $request->age;
            $deathRecord->gender = $request->gender;
            $deathRecord->address = $request->address;
            $deathRecord->marital_status = $request->maritalstatus;
            $deathRecord->father_name = $request->fathername;
            $deathRecord->mother_name = $request->mothername;
            $deathRecord->spouse_name = $request->spousename;
            $deathRecord->issued_by = $request->issuedby;
    
            if ($request->hasFile('imgfile')) {
                $image = $request->file('imgfile');
                $extension = $image->getClientOriginalExtension();
                $filename = 'img_' . time() . '.' . $extension;
                $path = $image->storeAs('assets/deceased', $filename, 'public');
                // Store the relative path for use in your application
                $deathRecord->image_path = 'storage/' . $path;
            }
    
            $deathRecord->save();
            Token::where('patient_regn_no',$request->regn)->where('deceased_status','Y')->update([
                'deceased_status'=>'Y-R'
            ]);
            return response()->json(['status' => true, 'message' => 'Death record saved successfully.']);
    
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'An error occurred while saving the death record.'], 500);
        }
    }
    
    

}
