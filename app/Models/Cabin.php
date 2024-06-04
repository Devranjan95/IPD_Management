<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    use HasFactory;
    protected $table = "cabins";
    protected $fillable = [
        'cabin_name',
        'cabin_code',
        'cabin_type',
        'floor_no',
        'block',
        'occupancy',
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
}
