<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewBorn extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'new_borns';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Enable timestamps if you are using created_at and updated_at fields
    public $timestamps = true;

    // Define which attributes are mass assignable
    protected $fillable = [
        'birth_record_id',
        'birthdate',
        'birthtime',
        'placeofbirth',
        'gender',
        'weight',
        'length',
    ];

    // Define the relationship to the BirthRecord model
    public function birthRecord()
    {
        return $this->belongsTo(BirthRecord::class, 'birth_record_id');
    }
}
