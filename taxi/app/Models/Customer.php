<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use  HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'bank_name',
        'account_number',
        'picture',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'rides');
    }

    public function rides()
    {
        return $this->hasMany(Ride::class);
    }
}
