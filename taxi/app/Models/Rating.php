<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_id',
        'feedback',
        'rating',
    ];
    public $timestamps = false;

    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id');
    }
}
