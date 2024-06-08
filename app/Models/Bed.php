<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;
    protected $table = "beds";
    protected $fillable = [
        'bed_name',
        'bed_type_id',
        'bed_category_id',
        'no_of_beds',
        'assigned_no',
        'available',
        'narration',
        'status',
        'created_by',
        'updated_by'
    ];

    public function user()
	{
		return $this->belongsTo(User::class);
	}
    public function bedtype()
	{
		return $this->belongsTo(BedType::class);
	}
    public function bedcategory()
	{
		return $this->belongsTo(BedCategory::class);
	}
}
