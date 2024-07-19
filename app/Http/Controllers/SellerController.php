<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {        $user = auth()->user();
        $shop = Shops::where('user_id', $user->id)->first();
        return view('seller-panel.index',compact('user', 'shop'));
    }
}
