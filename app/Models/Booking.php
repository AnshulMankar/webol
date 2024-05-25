<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier',
        'name',
        'status',
        'gender',
        'age',
        'aadhar_card_number',
        'identity_proof',
        'address',
        'state',
        'city',
        'phone_number',
        'covid_status',
        'date_of_positive',
        'cylinder_option',
    ];
}
