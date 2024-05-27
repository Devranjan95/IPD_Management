<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinType extends Model
{
    use HasFactory;
    protected $table = "cabin_types";
    protected $fillable = [
        'cabin_type',
        'status',
        'created_by',
        'updated_by'
    ];
    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
