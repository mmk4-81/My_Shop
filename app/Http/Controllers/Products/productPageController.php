<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class productPageController extends Controller
{
    public function show(Product $product)
    {
        // dd($product->name);
        return view('products.show' , compact('product'));
    }
}
