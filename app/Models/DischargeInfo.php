<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DischargeInfo extends Model
{
    use HasFactory;

    protected $table = "discharge_infos";
    protected $fillable = [
        'patient_regn_no',
        'patient_name',
        'contact',
        'clearance',
        'patient_status',
        'date_of_discharge',
        'time_of_discharge',
        'discharge_summary'
    ];
}
