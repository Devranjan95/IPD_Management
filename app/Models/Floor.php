<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $table = "floors";
    protected $fillable = [
        'count',
        'floor_no',
        'status',
        'narration',
        'created_by',
        'updated_by'
    ];

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
