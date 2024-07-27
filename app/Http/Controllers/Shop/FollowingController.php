<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Following;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function follow($shopId)
    {
        $userId = Auth::id();
        $shop = Shops::findOrFail($shopId);

        if (Following::where('follower_id', $userId)->where('following_shop_id', $shopId)->exists()) {
            toastr()->closeButton()->error('شما قبلاً این فروشگاه را دنبال کرده‌اید');
            return redirect()->back();
        }

        Following::create([
            'follower_id' => $userId,
            'following_shop_id' => $shopId,
            'following_date' => now(),
        ]);
        toastr()->closeButton()->success('فروشگاه با موفقیت دنبال شد');
        return redirect()->back();
    }

    public function unfollow($shopId)
    {
        $userId = Auth::id();

        Following::where('follower_id', $userId)
            ->where('following_shop_id', $shopId)
            ->delete();
            toastr()->closeButton()->success('فروشگاه با موفقیت از لیست دنبال‌کننده‌ها حذف شد');
        return redirect()->back();
    }

    public function followedShops()
    {
        $userId = Auth::id();
        $followedShops = Auth::user()->followedShops;

        return view('shops.index', compact('followedShops'));
    }
}
