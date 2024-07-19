<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // public function add_product()
    // {
    //     $category = Category::all();

    //     return view('admin.add_product',compact('category'));
    // }


    // public function upload_product(Request $request)
    // {
    //     $data = new Product;

    //     $data->name = $request->title;
    //     $data->description = $request->description;

    //     $image = $request->image;
    //     if($image){
    //         $imageName = time(). '.'. $image->getClientOriginalExtension();
    //         $image->move('uploads/products', $imageName);
    //         $data->primary_image = $imageName;
    //     }
    //     $data->save();

    //     toastr()->closeButton()->success(' محصول با موفقیت اضافه شد');

    //     return redirect()->back();

    // }

    public function view_product()
    {
        $data = Product::all();
      $user = auth()->user();

        return view('admin.products.view_product',compact('data','user'));
    }

    public function delete_products($id)
    {
        $data = Product::find($id);

        $image_path = public_path('/uploads/products/'.$data->primary_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();

        toastr()->closeButton()->success(' محصول با موفقیت حذف شد');


        return redirect()->back();

    }

    public function edit_products($id)
{
    $data = Product::find($id);

    // Check if $data is a single object
    if (!$data) {
        return redirect()->back()->with('error', 'محصول یافت نشد.');
    }

    $user = auth()->user();
    return view('admin.products.edit_products', compact('data','user'));
}


    public function update_products(Request $request,$id)
    {
        $data = Product::find($id);
        $data->name = $request->title;
        $data->description = $request->description;
        $image = $request->image;
        if($image){
            $imageName = time(). '.'. $image->getClientOriginalExtension();
            $image->move('uploads/products', $imageName);
            $data->primary_image = $imageName;
        }
        $data->save();
        toastr()->closeButton()->success('محصول با موفقیت ویرایش شد');


        return redirect('/admin/view_product');
    }

    public function search_product(Request $request)
    {
        $search = $request->search;
          $user = auth()->user();

        $data = Product::where('name','LIKE','%'.$search.'%')->get();
        return view('admin.products.view_product',compact('data', 'user'));
    }

    public function latestProducts()
    {
        $products = Product::orderBy('created_at', 'desc')->take(10)->get();
        return view('products.latest', compact('products'));
    }
}

