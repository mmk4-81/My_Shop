<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;


    protected $fillable = [
        'parent_id',
        'category_name',
        'slug',
        'description',
        'icon',
        'is_active',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot('is_filter', 'is_variation');
    }
}
