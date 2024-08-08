<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Token;
use App\Models\Bed;
use App\Models\BirthRecord;
use App\Models\NewBorn;
use App\Models\DeathRecord;


class ReportController extends Controller
{
    public function index(){
        //$birthInfos = BirthRecord::all();
        $birthData = BirthRecord::all();
        //dd($birthData);
        return view("backend.Reports.birthreports",["birthData"=>$birthData]);
        //return view("backend.Reports.birthreports",["birthInfos"=>$birthInfos]);
    }
    public function getNewBorn($id){
        //$datas = BirthRecord::with('newborn')->where('id', $id)->first();
        //dd($datas);
        // $newBornDatas = $datas->newborn; // Extract newborn data
        // return view('backend.Reports.birthindividual', ['newBornDatas' => $newBornDatas]);
        $datas = BirthRecord::with('newborn')->where('id', $id)->get();
        return view('backend.Reports.birthindividual', ['datas' => $datas]);
    }

    public function index_death(){
        $deathInfos = DeathRecord::all();
        return view("backend.Reports.deathreports",["deathInfos"=>$deathInfos]);
    }
    public function DeathIndividual($regn){
        // Replacing dashes with slashes
        $regn = str_replace('-', '/', $regn);
        $individualdeath = DeathRecord::where('patient_regn_no',$regn)->first();
        //dd($individualdeath);
        
        if($individualdeath){
            return view("backend.Reports.individualdeath", ['individualdeath' => $individualdeath]);
        } else {
            return abort(404, 'Patient not found');
        }
    }

    public function index_patient(){
        $patientInfos = Patient::all();
        return view("backend.Reports.patientreports",["patientInfos"=>$patientInfos]);
    }
    public function PatientIndividual($regn){
        // Replacing dashes with slashes
        $regn = str_replace('-', '/', $regn);
        
        // Fetching patient details with associated tokens
        $individual = Patient::with('tokens')->where('patient_regn_no', $regn)->get();
        
        // Check if any patient record was found
        if($individual->isNotEmpty()){
            return view("backend.Reports.patientindividualreport", ['individual' => $individual]);
        } else {
            return abort(404, 'Patient not found');
        }
    }
    

    public function index_discharge(){
        $dischargedTokens = Token::with('patient')->where('status','Discharged')->get();
        //dd($dischargedTokens);
        
        return view("backend.Reports.dischargereports",["dischargedTokens"=>$dischargedTokens]);
    }
    public function getDischargePatient($id){
        //dd($id);
        $infos = Token::with('patient')->where('id',$id)->where('status','Discharged')->get();
        //dd($infos);
        return view('backend.Reports.individualDischarge',['infos'=>$infos]);
    }


    public function index_bed(){
        //$dischargedTokens = Token::with('patient')->where('status','Discharged')->get();
        //dd($dischargedTokens);
        $tokensGroupedByBedType = Token::select('bedtype', \DB::raw('count(*) as total'))
        ->groupBy('bedtype')
        ->get();
        $bedInfos = [];

        // Retrieve the bed name for each bed type
        foreach ($tokensGroupedByBedType as $group) {
            $bed = Bed::find($group->bedtype);
            //dd($bed->id);
            if ($bed) {
                $bedInfos[] = [
                    'bedid' => $bed->id,
                    'bedtype' => $group->bedtype,
                    'bedname' => $bed->bed_name, 
                    'totalbed' => $bed->assigned_no, // Assuming the bed name is stored in a 'name' column
                    'totalPatient' => $group->total,
                ];
            }
        }
        //dd($bedInfos);
        
        return view("backend.Reports.bedwisereports",["bedInfos"=>$bedInfos]);
    }
    public function getBedwisePatient($id){
        //dd($id);
        $bedname = Bed::where('id',$id)->value('bed_name');
        $info = Token::with('patient')->where('bedtype', $id)->get();
        //dd($info);
        return view('backend.Reports.individualbedwisepatient',['info'=>$info,'bedname'=>$bedname]);
    }
}
