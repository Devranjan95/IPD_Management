<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationCount extends Model
{
    use HasFactory;
    protected $table = 'observation_counter';
	protected $fillable = [
		'counter',
		'date',
	];
}
