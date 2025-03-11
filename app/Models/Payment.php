<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    use HasFactory;

    protected $fillable = ['boarding_house_id', 'tenant_id', 'amount', 'payment_date'];

    public function boardingHouse() {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }
}


