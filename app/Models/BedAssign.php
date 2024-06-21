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
        'floor',
        'block',
        'bed_no',
        'bed_name',
    ];
}
