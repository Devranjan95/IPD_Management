<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Token;
use App\Models\BirthRecord;
use App\Models\NewBorn;


class BirthController extends Controller
{
    public function index(){
        $statusArray = ["Booked","InBed","Operation"];
        $regnvalues = Token::whereIn('status',$statusArray)->where('maternity_status',"Successfull")->select('patient_regn_no')->get();
        return view("backend.Discharge.birthrecordentry",["regnvalues"=>$regnvalues]);
    }

    public function searchPatient(Request $request){
        $statusArray = ["Booked","InBed","Operation","BabyBorn","Discharge InProgress"];
        $patientInfo = Patient::where('patient_regn_no',$request->regn)->first();
        $tokenInfo = Token::where('patient_regn_no',$patientInfo->patient_regn_no)->whereIn('status',$statusArray)->where('maternity_status','Successfull')->first();
        //$tokenInfo = Token::where('patient_regn_no',$request->regn)->whereIn('status',$statusArray)->first();
        return response()->json(["message"=>"Patient found","patientInfo"=>$patientInfo,"tokenInfo"=>$tokenInfo]);
    }

    // public function saveBirthRecord(Request $request)
    // {
    //     // Debug incoming request data
    //     dd($request->all());
    
    //     // Define validation rules
    //     $rules = [
    //         'recordid' => 'nullable|integer',
    //         'regn' => 'required|string',
    //         'patname' => 'required|string',
    //         'contact' => 'required|digits:10',
    //         'fatheradhar' => 'required|digits:12',
    //         'motheradhar' => 'required|digits:12',
    //         'fathername' => 'required|string',
    //         'mothername' => 'required|string',
    //         'birthdate' => 'required|date',
    //         'birthtime' => 'required|date_format:H:i',
    //         'placeofbirth' => 'required|string',
    //         'gender' => 'required|in:Male,Female,Other',
    //         'weight' => 'required|numeric|min:0',
    //         'length' => 'required|numeric|min:0',
    //         'address' => 'required|string',
    //         'maritalstatus' => 'required|in:Single,Married,Widowed,Divorced',
    //         'issuedby' => 'required|string',
    //         'imgfile' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp,svg' // Adjust the image validation as needed
    //     ];
    
    //     // Validate the request
    //     $validator = Validator::make($request->all(), $rules);
    
    //     if ($validator->fails()) {
    //         return response()->json(['status' => false, 'message' => $validator->errors()->first()], 400);
    //     }
    
    //     try {
    //         // Save or update the birth record
    //         $birthRecord = $request->recordid ? BirthRecord::find($request->recordid) : new BirthRecord;
    
    //         $birthRecord->recordid = $request->recordid;
    //         $birthRecord->regn = $request->regn;
    //         $birthRecord->patname = $request->patname;
    //         $birthRecord->contact = $request->contact;
    //         $birthRecord->addmission_date = $request->addmissiondate;
    //         $birthRecord->addmission_time = $request->addmissiontime;
    //         $birthRecord->birthdate = $request->birthdate;
    //         $birthRecord->birthtime = $request->birthtime;
    //         $birthRecord->placeofbirth = $request->placeofbirth;
    //         $birthRecord->gender = $request->gender;
    //         $birthRecord->weight = $request->weight;
    //         $birthRecord->length = $request->length;
    //         $birthRecord->fathername = $request->fathername;
    //         $birthRecord->mothername = $request->mothername;
    //         $birthRecord->fatheradhar = $request->fatheradhar;
    //         $birthRecord->motheradhar = $request->motheradhar;
    //         $birthRecord->address = $request->address;
    //         $birthRecord->maritalstatus = $request->maritalstatus;
    //         $birthRecord->issuedby = $request->issuedby;
    
    //         if ($request->hasFile('imgfile')) {
    //             $image = $request->file('imgfile');
    //             $filename = 'img_' . time() . '.' . $image->getClientOriginalExtension();
    //             $path = $image->storeAs('assets/birth', $filename, 'public');
    //             $birthRecord->image_path = 'storage/' . $path;
    //         }
    
    //         $birthRecord->save();
            
    //         // Token::where('patient_regn_no',$request->regn)->where('maternity_status','Successfull')->update([
    //         //     'maternity_status'=>'Successfull-R'
    //         // ]);
    //         // Debug to ensure this line is reached
    //        // dd(1);
    
    //         return response()->json(['status' => true, 'message' => 'Birth record saved successfully.']);
    
    //     } catch (\Exception $e) {
    //         // Debug the exception message
    //         //dd($e->getMessage());
    
    //         return response()->json(['status' => false, 'message' => 'An error occurred while saving the birth record.'], 500);
    //     }
    // }
    
    public function saveBirthRecord(Request $request)
    {
        //dd($request);
        // Define validation rules
        $rules = [
            'recordid' => 'nullable|integer',
            'regnno' => 'required|string',
            'patname' => 'required|string',
            'contact' => 'required|digits:10',
            'fatheradhar' => 'required|digits:12',
            'motheradhar' => 'required|digits:12',
            'fathername' => 'required|string',
            'address' => 'required|string',
            'maritalstatus' => 'required|in:Single,Married,Widowed,Divorced',
            'issuedby' => 'required|string',
            'imgfile.*' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp,svg', // Adjust the image validation as needed
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
            $updateToken = Token::where('patient_regn_no',$request->regnno)
                                  ->where('date_of_addmission',$request->addmissiondate)
                                  ->where('time_of_addmission',$request->addmissiontime)
                                  ->update(["maternity_status"=>"Successful-R"]);
            // $tokenVal = Token::where('patient_regn_no',$request->regn)
            //                 ->where('date_of_addmission',$request->addmissiondate)
            //                 ->where('time_of_addmission',$request->addmissiontime)
            //                 ->first();
            // Save multiple new born entries
            $repeatCount = $request->input('repeatCount', 1);
            for ($i = 0; $i < $repeatCount; $i++) {
                // dd([
                //     'birthdate' => $request->input("birthdate_$i"),
                //     'birthtime' => $request->input("birthtime_$i"),
                //     'placeofbirth' => $request->input("placeofbirth_$i"),
                //     'gender' => $request->input("gender_$i"),
                //     'weight' => $request->input("weight_$i"),
                //     'length' => $request->input("length_$i"),
                // ]);
                $newBorn = new NewBorn(); // Use NewBorn model for newborn entries
                $newBorn->birth_record_id = $birthRecord->id;
                $newBorn->birthdate = $request->input("birthdate_$i");
                $newBorn->birthtime = $request->input("birthtime_$i");
                $newBorn->placeofbirth = $request->input("placeofbirth_$i");
                $newBorn->gender = $request->input("gender_$i");
                $newBorn->weight = $request->input("weight_$i");
                $newBorn->length = $request->input("length_$i");
                $newBorn->save();
                if ($request->hasFile('imgfile')) {
                    foreach ($request->file('imgfile') as $index => $image) {
                        $filename = 'img_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                        $path = $image->storeAs('assets/birth', $filename, 'public');
                        $imagePath = 'storage/' . $path;
                        
                        // Update the NewBorn entry with the image path
                        $newBorn->image_path = $imagePath;
                        $newBorn->save();
                    }
                }
            }

            $tokInfo = Token::where('patient_regn_no',$request->regnno)
                            ->where('date_of_addmission',$request->addmissiondate)
                            ->where('time_of_addmission',$request->addmissiontime)
                            ->first();
            return response()->json(['status' => true, 'message' => 'Birth record saved successfully.','tokinfo'=>$tokInfo]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while saving the birth record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
}
