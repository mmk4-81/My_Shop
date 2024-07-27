<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'credit',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'credit' => 'decimal:3',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function shop()
    {
        return $this->hasOne(Shops::class);
    }

    public function followings()
    {
        return $this->hasMany(Following::class, 'follower_id');
    }

    public function followedShops()
    {
        return $this->belongsToMany(Shops::class, 'followings', 'follower_id', 'following_shop_id')->withTimestamps();
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('uploads/avatars/' . $this->avatar);
        }
    }


}
