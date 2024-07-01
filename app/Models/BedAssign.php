<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedAssign extends Model
{
    use HasFactory;
    protected $table = "bed_assigns";
    protected $fillable = [
        'type',
        'type_name',
        'type_id',
        'floor_count',
        'block_id',
        'bed_no',
        'bed_name',
        'status'
    ];
}
