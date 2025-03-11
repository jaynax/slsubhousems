<?php
// In App\Models\Profile.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'phone', 'address', 'bio', 'profile_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

