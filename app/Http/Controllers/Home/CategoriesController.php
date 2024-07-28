<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Category $category)
    {
        $attributes = $category->attributes()->where('is_filter', 1)->with('values')->get();
        $variation = $category->attributes()->where('is_variation', 1)->with('variationValues')->first();
        $products = $category->products()->where('is_active', 1)->filter()->search()->paginate(9);
        $parentCategories = Category::where('parent_id', 0)->with('children')->get();

        return view('categories.show', compact('category', 'attributes', 'variation', 'products', 'parentCategories'));
    }





    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
