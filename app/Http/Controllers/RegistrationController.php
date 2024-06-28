<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;
use App\Models\BedAssign;

class RegistrationController extends Controller
{
    public function index(){
        $floor = Floor::all();
        $floorOccupancy = [];

        $floor = Floor::all();

        $floorOccupancy = [];

        foreach ($floor as $fl) {
            // Calculate for Cabin
            $blockinfo = Block::where('floor_count',$fl->count)->get();
            $bedno = [];
            foreach($blockinfo as $blk){
                    $bedassigninfo = BedAssign::where('block_id',$blk->id)->select('bed_no','type')->get();
                    $bedno[]=$bedassigninfo;
            }
            //dd($bedno);
            $cabinOccupancy = Cabin::where('floor_count', $fl->count)
                            ->selectRaw('SUM(total_occupancy) as total_occupancy_sum, SUM(assigned) as assigned_sum')
                            ->groupBy('floor_count')
                            ->first();

            $total_occupancy_sum_cabin = $cabinOccupancy ? $cabinOccupancy->total_occupancy_sum : 0;
            $assigned_sum_cabin = $cabinOccupancy ? $cabinOccupancy->assigned_sum : 0;
            $total_available_cabin = $total_occupancy_sum_cabin - $assigned_sum_cabin;

            // Calculate for Ward
            $wardOccupancy = Ward::where('floor_count', $fl->count)
                            ->selectRaw('SUM(total_occupancy) as total_occupancy_sum, SUM(assigned) as assigned_sum')
                            ->groupBy('floor_count')
                            ->first();

            $total_occupancy_sum_ward = $wardOccupancy ? $wardOccupancy->total_occupancy_sum : 0;
            $assigned_sum_ward = $wardOccupancy ? $wardOccupancy->assigned_sum : 0;
            $total_available_ward = $total_occupancy_sum_ward - $assigned_sum_ward;

            // Calculate for ICU
            $icuOccupancy = ICU::where('floor_count', $fl->count)
                            ->selectRaw('SUM(total_occupancy) as total_occupancy_sum, SUM(assigned) as assigned_sum')
                            ->groupBy('floor_count')
                            ->first();

            $total_occupancy_sum_icu = $icuOccupancy ? $icuOccupancy->total_occupancy_sum : 0;
            $assigned_sum_icu = $icuOccupancy ? $icuOccupancy->assigned_sum : 0;
            $total_available_icu = $total_occupancy_sum_icu - $assigned_sum_icu;

            // Store the results in an array
            $floorOccupancy[] = [
                'floor_no' => $fl->floor_no,
                'total_occupancy_sum_cabin' => $total_occupancy_sum_cabin,
                'assigned_sum_cabin' => $assigned_sum_cabin,
                'total_available_cabin' => $total_available_cabin,
                'total_occupancy_sum_ward' => $total_occupancy_sum_ward,
                'assigned_sum_ward' => $assigned_sum_ward,
                'total_available_ward' => $total_available_ward,
                'total_occupancy_sum_icu' => $total_occupancy_sum_icu,
                'assigned_sum_icu' => $assigned_sum_icu,
                'total_available_icu' => $total_available_icu,
                'blockinfo' => $blockinfo,
                'bedno'=>$bedno
            ];
        }
        //dd($floorOccupancy);
        return view('backend.registration',['floor'=>$floor,'floorOccupancy'=>$floorOccupancy]);
    }
}
