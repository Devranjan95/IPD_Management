<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Token;
use App\Models\BirthRecord;
use App\Models\DeathRecord;


class ReportController extends Controller
{
    public function index(){
        $birthInfos = BirthRecord::all();
        return view("backend.Reports.birthreports",["birthInfos"=>$birthInfos]);
    }

    public function index_death(){
        $deathInfos = DeathRecord::all();
        return view("backend.Reports.deathreports",["deathInfos"=>$deathInfos]);
    }
}
