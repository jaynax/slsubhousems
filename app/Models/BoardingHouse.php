<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'location',
        'contact_number',
        'description',
        'image', // ✅ just the field name here
    ];

    // Each boarding house belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each boarding house can have many tenants
    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'boarding_house_id');
    }
}
