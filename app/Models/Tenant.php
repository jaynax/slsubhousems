<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'boarding_house_id', 'room_number', 'rent_status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
