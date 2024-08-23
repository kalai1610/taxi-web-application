<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'ride_id',
        'status',
        'tax',
        'total_payment',
        'booking_charge'
    ];

    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id');
    }
}
