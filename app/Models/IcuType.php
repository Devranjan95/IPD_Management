<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IcuType extends Model
{
    use HasFactory;
    protected $table = "icu_types";
    protected $fillable = [
        'icu_type',
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
