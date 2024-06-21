<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;
    protected $table = "amenities";
    protected $fillable = [
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
}
