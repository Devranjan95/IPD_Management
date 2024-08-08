<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Token;

class DashboardController extends Controller
{
    public function index()
    {
        $statusArray = ['Booked','InBed'];
        $totalPatients = Token::count();
        $totalInBedPatients = Token::whereIn('status', $statusArray)->count();
        $totalDeceased = Token::where('deceased_status', 'Y-R')->count();
        $totalBorn = Token::where('maternity_status', 'Successfull-R')->count();
        $totalDischarged = Token::where('status', 'Discharged')->count();

        return view('backend.Dashboard.dashboard', compact(
            'totalPatients',
            'totalInBedPatients',
            'totalDeceased',
            'totalBorn',
            'totalDischarged'
        ));
    }
}
