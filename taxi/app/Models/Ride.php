<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'pickup_latitude',
        'pickup_longitude',
        'destination_latitude',
        'destination_longitude',
        'status',
        'time',
        'amount',
        'pickup_address',
        'destination_address',
        'driver_id',
        'distance'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class, 'ride_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'ride_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
