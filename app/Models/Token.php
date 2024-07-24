<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "tokens";
    protected $fillable = [
        'patient_regn_no',
        'token_no',
        'attendant_name',
        'attendant_phone',
        'bednumber',
        'bedtype',
        'flag',
        'category_id',
        'type_name_id',
        'type_price_24hr',
        'extra_amenity',
        'amenity_start_date',
        'amenity_end_date',
        'adv_amount',
        'date_of_addmission',
        'time_of_addmission',
        'emergency',
        'treating_type',
        'reffered_from',
        'date_of_discharge',
        'time_of_discharge',
        'total_stay_hr',
        'discharge_summary',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_regn_no','patient_regn_no');
    }
}
