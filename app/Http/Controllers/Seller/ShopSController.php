<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Shops;
use Illuminate\Http\Request;

class ShopSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = Shops::where('user_id', auth()->id())->first();
        return view('seller-panel.shops.index', compact('shop'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shop = Shops::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('seller-panel.shops.edit', compact('shop'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shop = Shops::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $shop->shop_name = $request->input('shop_name');
        $shop->description = $request->input('description');

        if ($request->hasFile('avatar_shops')) {
            $avatarName = time() . '.' . $request->avatar_shops->extension();
            $request->avatar_shops->move(public_path('uploads/avatars/shops'), $avatarName);
            $shop->avatar_shops = $avatarName;
        }

        $shop->save();
        toastr()->closeButton()->success('فروشگاه با موفقیت به روز شد');

        return redirect()->route('seller.myshop.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shop = Shops::find($id);

        if (!$shop) {
            return redirect()->back()->with('error', 'فروشگاه یافت نشد');
        }
        $seller = $shop->user;
        if ($seller) {
            $role = Role::where('name', 'seller')->first();

            if ($role) {
                $seller->roles()->detach($role->id);
            } else {
                return redirect()->back()->with('error', 'نقش فروشنده یافت نشد');
            }
            $shop->delete();

            toastr()->success('فروشگاه با موفقیت حذف شد');

            return redirect()->route('home');
        }
    }





}
