<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;
    protected $table = "beds";
    protected $fillable = [
        'bed_no',
        'bed_type',
        'bed_code',
        'floor_id',
        'block_id',
        'cabin',
        'cabin_type_id',
        'cabin_id',
        'ward',
        'ward_type_id',
        'ward_id',
        'icu',
        'icu_type_id',
        'icu_id',
        'status',
        'narration',
        'created_by',
        'updated_by'
    ];

    public function user()
	{
		return $this->belongsTo(User::class);
	}
    public function floor()
	{
		return $this->belongsTo(Floor::class);
	}
    public function block()
	{
		return $this->belongsTo(Block::class);
	}
    public function cabintype()
	{
		return $this->belongsTo(CabinType::class);
	}
    public function wardtype()
	{
		return $this->belongsTo(WardType::class);
	}
    public function icutype()
	{
		return $this->belongsTo(IcuType::class);
	}
    public function cabin()
	{
		return $this->belongsTo(Cabin::class);
	}
    public function ward()
	{
		return $this->belongsTo(Ward::class);
	}
    public function icu()
	{
		return $this->belongsTo(Icu::class);
	}
}
