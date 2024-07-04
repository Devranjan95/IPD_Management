<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurgeryCount extends Model
{
    use HasFactory;
    protected $table = 'surgery_counter';
	protected $fillable = [
		'counter',
		'date',
	];
}
