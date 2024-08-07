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
        $newborns = NewBorn::all();
        dd($newborns);
        return view("backend.Reports.birthreports",["newborns"=>$newborns]);
        //return view("backend.Reports.birthreports",["birthInfos"=>$birthInfos]);
    }

    public function index_death(){
        $deathInfos = DeathRecord::all();
        return view("backend.Reports.deathreports",["deathInfos"=>$deathInfos]);
    }

    public function index_patient(){
        $patientInfos = Patient::all();
        return view("backend.Reports.patientreports",["patientInfos"=>$patientInfos]);
    }

    public function index_discharge(){
        $dischargedTokens = Token::with('patient')->where('status','Discharged')->get();
        //dd($dischargedTokens);
        
        return view("backend.Reports.dischargereports",["dischargedTokens"=>$dischargedTokens]);
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
            //dd($bed);
            if ($bed) {
                $bedInfos[] = [
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
}
