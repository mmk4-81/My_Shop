<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $table = "product_variations";
    protected $fillable = [
        'attribute_id', 'product_id', 'value', 'price', 'quantity',
    ];
}
