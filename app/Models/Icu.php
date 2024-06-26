<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class icu extends Model
{
    use HasFactory;
    protected $table = "icu";
    protected $fillable = [
        'icu_name',
        'icu_type_id',
        'floor_count',
        'block_id',
        'total_occupancy',
        'assigned',
        'available',
        'amenities',
        'price',
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
		return $this->belongsTo(Floor::class,'floor_count','count');
	}
    public function block()
	{
		return $this->belongsTo(Block::class,'block_id','id');
	}
    public function icutype()
	{
		return $this->belongsTo(IcuType::class,'icu_type_id','id');
	}
    public function bedAssign()
	{
		return $this->belongsTo(BedAssign::class);
	}
}
