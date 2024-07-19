<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shops;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {        $user = auth()->user();
        return view('admin-panel.index',compact('user'));
    }
    public function getUsers()
    {
            $user = auth()->user();
            $shop = Shops::where('user_id', $user->id)->first();
            return view('admin.dashboardlayout', compact('user','shop'));
    }
}
