<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'shop_id',
        'category_id',
        'primary_image',
        'description',
        'is_active',
    ];

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }



    public function shop()
    {
        return $this->belongsTo(Shops::class, 'shop_id');
    }

    public function getShopName()
    {
        return $this->shop ? $this->shop->shop_name : 'بدون فروشگاه';
    }
    public function getQuantityCheckAttribute()
    {
        return $this->variations()->where('quantity', '>', 0)->first() ?? 0;
    }

    public function getPriceCheckAttribute()
    {
        return $this->variations()->where('quantity', '>', 0)->orderBy('price')->first() ?? false;
    }

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

    public function getPriceAttribute()
    {
        $variation = $this->variations()->where('quantity', '>', 0)->orderBy('price')->first();
        return $variation ? $variation->price : null;
    }

    public function scopeFilter($query)
    {
        if (request()->has('attribute')) {
            foreach (request()->attribute as $attribue) {
                $query->whereHas('attributes', function ($query) use ($attribue) {
                    foreach (explode('-', $attribue) as $index => $item) {
                        if ($index == 0) {
                            $query->where('value', $item);
                        } else {
                            $query->orWhere('value', $item);
                        }
                    }
                });
            }
        }

        if (request()->has('variation')) {
            $query->whereHas('variations', function ($query) {
                foreach (explode('-', request()->variation) as $index => $variation) {
                    if ($index == 0) {
                        $query->where('value', $variation);
                    } else {
                        $query->orWhere('value', $variation);
                    }
                }
            });
        }

        if (request()->has('sortBy')) {
            $sortBy = request()->sortBy;

            switch ($sortBy) {
                case 'max':
                    $query->orderByDesc(ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('price', 'desc')->take(1));
                    break;
                case 'min':
                    $query->orderBy(ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('price', 'desc')->take(1));
                    break;
                case 'latest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                default:
                    $query;
                    break;
            }
        }
        // dd($query->toSql());
        return $query;
    }

    public function scopeSearch($query)
    {
        $keyword = request()->search;
        if (request()->has('search') && trim($keyword) != '') {
            $query->where('name', 'LIKE', '%' . trim($keyword) . '%');
        }

        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
