<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        $user = auth()->user();

        $currentUrl = url()->current();

        if (strpos($currentUrl, '/admin') !== false) {
            return view('admin.category.category', compact('data', 'user'));
        } else if (strpos($currentUrl, '/seller') !== false) {
            return view('seller.category.category', compact('data', 'user'));
        } else {
            abort(404);
        }
    }

    public function add_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category;
        $category->save();
        toastr()->closeButton()->success('دسته بندی با موفقیت اضافه شد');


        return redirect()->back();
    }


    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();

        toastr()->closeButton()->success('دسته بندی با موفقیت حذف شد');


        return redirect()->back();

    }


    public function edit_category($id)
    {
        $data = Category::find($id);
        $user = auth()->user();

        $currentUrl = url()->current();
        if (strpos($currentUrl, '/admin') !== false) {
            return view('admin.category.edit_category', compact('data', 'user'));
        } else if (strpos($currentUrl, '/seller') !== false) {
            return view('seller.category.edit_category', compact('data', 'user'));
        } else {
            abort(404);
        }

    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->closeButton()->success('دسته بندی با موفقیت ویرایش شد');
        $currentUrl = url()->current();
        if (strpos($currentUrl, '/admin') !== false) {
            return redirect('/admin/view_category');
        } else if (strpos($currentUrl, '/seller') !== false) {
            return redirect('/seller/view_category');
        } else {
            abort(404);
        }

    }
}
