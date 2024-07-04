<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdProof extends Model
{
    use HasFactory;
    protected $table = "idproofs";
    protected $fillable = [
        "id_name",
        "id_code",
        "id_val_length",
        "status",
        "narration",
        "created_by",
        "updated_by"
    ];
}
