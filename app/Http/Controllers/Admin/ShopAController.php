<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Shops;
use Illuminate\Http\Request;

class ShopAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shops::with('user')->latest()->paginate(4);
        return view('admin-panel.shops.index', compact('shops'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Shops $shop)
    {
        return view('admin-panel.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shops $shop)
    {
        $seller = $shop->user;

        if ($seller) {
            $seller->roles()->detach(Role::where('name', 'seller')->first()->id);
        }

        $shop->delete();

        toastr()->closeButton()->success('فروشگاه با موفقیت حذف شد');

        return redirect()->back();
    }
}
