<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorySController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('seller-panel.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();
        return view('seller-panel.categories.create', compact('parentCategories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);



        $category = Category::create([
            'category_name' => $request->name,
            'parent_id' => $request->parent_id,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        // foreach ($request->attribute_ids as $attributeId) {
        //     $attribute = Attribute::findOrFail($attributeId);
        //     $attribute->categories()->attach($category->id, [
        //         'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
        //         'is_variation' => $request->variation_id == $attributeId ? 1 : 0
        //     ]);
        // }


        toastr()->closeButton()->success('دسته بندی با موفقیت اضافه شد');
        return redirect()->route('seller-panel.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('seller-panel.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();

        return view('seller-panel.categories.edit', compact('category', 'parentCategories', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id,
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);

        $category->update([
            'category_name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        $category->attributes()->detach();

        foreach ($request->attribute_ids as $attributeId) {
            $attribute = Attribute::findOrFail($attributeId);
            $attribute->categories()->attach($category->id, [
                'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                'is_variation' => $request->variation_id == $attributeId ? 1 : 0
            ]);
        }
        toastr()->closeButton()->success('دسته بندی با موفقیت ویرایش شد');
        return redirect()->route('seller.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        toastr()->closeButton()->success('دسته بندی با موفقیت حذف شد');

        return redirect()->back();
    }
}
