<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $table = "blocks";
    protected $fillable = [
        'block_name',
        'block_code',
        'floor_id',
        'status',
        'created_by',
        'updated_by'
    ];

    public function floor()
	{
		return $this->belongsTo(Floor::class);
	}
    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
