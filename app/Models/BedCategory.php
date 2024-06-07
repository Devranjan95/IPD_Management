<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedCategory extends Model
{
    use HasFactory;
    protected $table = "bed_categories";
    protected $fillable = [
        'bed_category',
        'narration',
        'status',
        'created_by',
        'updated_by'
    ];

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
