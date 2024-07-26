<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'birthrecord';
    protected $fillable = [
        'recordid',
        'regn',
        'patname',
        'contact',
        'birthdate',
        'birthtime',
        'placeofbirth',
        'gender',
        'weight',
        'length',
        'fathername',
        'mothername',
        'fatheradhar',
        'motheradhar',
        'address',
        'maritalstatus',
        'image_path',
        'issuedby',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'birthdate' => 'date',
    //     'birthtime' => 'time',
    //     'weight' => 'decimal:2',
    //     'length' => 'decimal:1',
    // ];
}
