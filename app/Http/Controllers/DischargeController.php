<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Token;

class DischargeController extends Controller
{
    //
    public function index(){
        $regnvalues = Token::where('status','Booked')->select('patient_regn_no')->get();
        return view('backend.Discharge.dischargeform',['regnvalues'=>$regnvalues]);
    }
}
