<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableCylinderSupplier extends Model
{
    use HasFactory;

    protected $table = 'available_cylinders';
    protected $fillable = [
        'user_id',
        '5ltr',
        '10ltr',
        '15ltr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
