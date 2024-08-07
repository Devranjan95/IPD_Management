<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeathRecord extends Model
{
    use HasFactory;

    protected $table = 'deathrecord';

    protected $fillable = [
        'patient_regn_no',
        'patient_name',
        'contact_no',
        'adhr_no',
        'attendant_name',
        'date_of_addmission',
        'time_of_addmission',
        'date_of_death',
        'time_of_death',
        'place_of_death',
        'cause_of_death',
        'age',
        'image_path',
        'gender',
        'address',
        'marital_status',
        'father_name',
        'mother_name',
        'spouse_name',
        'issued_by'
    ];
}
