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
        'narration',
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
    public function cabins()
    {
        return $this->hasMany(Cabin::class);
    }
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
    public function icus()
    {
        return $this->hasMany(Icu::class);
    }
}
