<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CategorySController extends Controller
{
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
            'category_name' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
            'variation_id' => 'required|exists:attributes,id',
        ]);

        try {
            DB::beginTransaction();

            $category = Category::create([
                'category_name' => $request->category_name,
            'parent_id' => $request->parent_id,
            ]);

            foreach ($request->attribute_ids as $attributeId) {
                $attribute = Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation' => $request->variation_id == $attributeId ? 1 : 0
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr()->closeButton()->success('دسته بندی با موفقیت اضافه نشد');
            return redirect()->back();
        }


        toastr()->closeButton()->success('دسته بندی با موفقیت اضافه شد');

        return redirect()->route('seller.categories.index');
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
            'category_name' => 'required',
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
            'variation_id' => 'required|exists:attributes,id',
        ]);


        try {
            DB::beginTransaction();

            $category->update([
                'category_name' => $request->category_name,
                'parent_id' => $request->parent_id,
            ]);

            $category->attributes()->detach();

            foreach ($request->attribute_ids as $attributeId) {
                $attribute = Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation' => $request->variation_id == $attributeId ? 1 : 0
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr()->closeButton()->error('دسته بندی با موفقیت ویرایش نشد');
            return redirect()->back();
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
    public function getCategoryAttributes(Category $category)
    {
        $attributes = $category->attributes()->wherePivot('is_variation' ,0)->get();
        $variation = $category->attributes()->wherePivot('is_variation' ,1)->first();
        return ['attrubtes' => $attributes , 'variation' => $variation];
       }
}
