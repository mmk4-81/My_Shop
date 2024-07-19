<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function create()
    {
        return view('shops.create_shops');
    }
    public function dl()
    {
        return view('layouts.dashboard');
    }

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
            $avatar->move(public_path('uploads/avatars'), $avatarName);
            $shop->avatar_shops = $avatarName;
        }

        $shop->save();

        // $user = auth()->user();
        // if ($user->role === 'user') {
        //     $user->role = 'seller';
        //     $user->save();
        // }

        return redirect()->route('shops.create')->with('success', 'فروشگاه با موفقیت ایجاد شد.');
    }
}
