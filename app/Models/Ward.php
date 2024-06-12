<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = "wards";
    protected $fillable = [
        'ward_name',
        'ward_type_id',
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
