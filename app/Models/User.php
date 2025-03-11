<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Ensure role_id is fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship: A user belongs to a role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id'); // Ensure 'role_id' is used as FK
    }
    // In App\Models\User.php
public function profile()
{
    return $this->hasOne(Profile::class);
}
public function showProfile()
{
    $user = Auth::user();  // Get the currently authenticated user
    return view('profile.index', compact('user'));
}


}
