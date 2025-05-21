<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',     // ✅ use user_id instead of owner_id
        'name',
        'location',    // ✅ renamed from address
        'contact_number',
        'description', // optional if you want to include it
    ];

    // ✅ Each boarding house belongs to a user (with role_id = 3)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Tenants (if you implement tenant relationship later)
    public function tenants()
{
    return $this->hasMany(Tenant::class, 'boarding_house_id');
}

}
