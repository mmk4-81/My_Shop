<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Role;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shops::latest()->paginate(12);
        $followedShops = Auth::check() ? Auth::user()->followedShops->pluck('id')->toArray() : [];

        return view('shops.index', compact('shops', 'followedShops'));
    }

    public function show($id)
    {
        $shop = Shops::findOrFail($id);
        $products = Product::where('shop_id', $shop->id)->where('is_active', 1)->get();
        $followedShops = Auth::check() ? Auth::user()->followedShops->pluck('id')->toArray() : [];
        $followersCount = $shop->followersCount();

        return view('shops.show', compact('shop', 'followersCount', 'followedShops', 'products'));
    }


    public function search_shops(Request $request)
    {
        $search = $request->input('search');
        $shops = Shops::where('shop_name', 'LIKE', '%' . $search . '%')->paginate(12);
        $followedShops = Auth::check() ? Auth::user()->followedShops->pluck('id')->toArray() : [];
        return view('shops.index', compact('shops', 'followedShops'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check() && auth()->user()->hasRole('seller')) {
            toastr()->closeButton()->error('شما اجازه ورود به این صفحه را ندارید');
            return redirect()->back();
        }

        return view('shops.create_shops');
    }



    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'avatar_shops' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = new Shops();
        $shop->user_id = auth()->id();
        $shop->shop_name = $validatedData['shop_name'];
        $shop->description = $validatedData['description'];

        if ($request->hasFile('avatar_shops')) {
            $avatar = $request->file('avatar_shops');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/avatars/shops'), $avatarName);
            $shop->avatar_shops = $avatarName;
        }

        $shop->save();

        $user = auth()->user();
        $roleSeller = Role::where('id', 3)->first();

        if ($user && $roleSeller) {
            $user->roles()->attach($roleSeller);
        }

        toastr()->closeButton()->success('فروشگاه با موفقیت ایجاد شد');

        return redirect()->route('seller.dashboard.index');
    }





    /**
     * Show the form for editing the specified resource.
     */
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
