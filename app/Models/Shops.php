<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_name',
        'slug',
        'avatar_shops',
        'description',
        'is_active',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'shop_name'
            ]
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followings', 'following_shop_id', 'follower_id')->withTimestamps();
    }

    public function followersCount()
    {
        return Following::where('following_shop_id', $this->id)->count();
    }

}
