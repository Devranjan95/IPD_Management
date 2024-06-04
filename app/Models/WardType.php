<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WardType extends Model
{
    use HasFactory;
    protected $table = "ward_types";
    protected $fillable = [
        'ward_type',
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
