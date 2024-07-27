<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $shop = $user->shop;

        if ($shop) {
            $products = Product::where('shop_id', $shop->id)->latest()->paginate(5);
        } else {
            $products = collect();
        }

        return view('seller-panel.products.index', compact('products'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('seller-panel.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'is_active' => 'required',
            'description' => 'required',
            'primary_image' => 'required|mimes:jpg,jpeg,png,svg',
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,svg',
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer',
            'variation_values.quantity.*' => 'integer',
        ]);

        $productImageController = new ProductImageController();
        $fileNameImages = $productImageController->upload($request->primary_image, $request->images);
        $user = auth()->user();
        $shopId = $user->shop->id;
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'shop_id' => $shopId,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'slug' => $request->slug,
            'primary_image' => $fileNameImages['fileNamePrimaryImage'],
        ]);
        foreach ($fileNameImages['fileNameImages'] as $fileNameImage) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $fileNameImage
            ]);
        }
        $productAttributeController = new ProductAttributeController();
        $productAttributeController->store($request->attribute_ids, $product);


        $category = Category::find($request->category_id);
        $productVariationController = new ProductVariationController();
        $productVariationController->store($request->variation_values, $category->attributes()->wherePivot('is_variation', 1)->first()->id, $product);

        return redirect()->route('seller.products.index')->with('success', 'محصول با موفقیت ثبت شد');
    }




    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $images = $product->images;

        return view('seller-panel.products.show', compact('product', 'productAttributes', 'productVariations', 'images'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('seller-panel.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'is_active' => 'required',
            'description' => 'required',

        ]);


        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'slug' => $request->slug,
        ]);


        return redirect()->route('seller.products.index')->with('success', 'محصول با موفقیت ثبت شد');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        ProductImage::where('product_id', $product->id)->delete();

        ProductAttribute::where('product_id', $product->id)->delete();

        ProductVariation::where('product_id', $product->id)->delete();

        $product->delete();

        toastr()->success('محصول با موفقیت حذف شد');

        return redirect()->route('seller.products.index');
    }


    public function editCategory(Request $request, Product $product)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('seller-panel.products.edit_category', compact('product', 'categories'));
    }

    public function updateCategory(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer',
            'variation_values.quantity.*' => 'integer'
        ]);
        try {
            DB::beginTransaction();

            $product->update([
                'category_id' => $request->category_id
            ]);

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->change($request->attribute_ids, $product);

            $category = Category::find($request->category_id);
            $productVariationController = new ProductVariationController();
            $productVariationController->change($request->variation_values, $category->attributes()->wherePivot('is_variation', 1)->first()->id, $product);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::error('خطا در ذخیره محصول: ' . $ex->getMessage());
            return redirect()->back();
        }

        return redirect()->route('seller.products.index')->with('success', 'محصول با موفقیت ثبت شد');

    }
}
