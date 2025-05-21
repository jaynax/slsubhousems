<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'boarding_house_id',
        'name',
        'contact_number',
        'notes',
        'status',
    ];

    

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
    // Tenant.php
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
