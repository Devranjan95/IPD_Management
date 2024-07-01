<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = "patients";
    protected $fillable = [
        'patient_regn_no',
        'patient_name',
        'patient_phone',
        'patient_email',
        'patient_address',
    ];
}
