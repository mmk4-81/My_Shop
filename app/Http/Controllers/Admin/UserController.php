<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(5);
        $user = auth()->user();
        $roles = Role::whereIn('name', ['admin', 'user'])->get();
        return view('admin-panel.users.index', compact('users', 'roles','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = User::with('roles')->get();
        $user = auth()->user();
        return view('admin-panel.users.create',compact('user','data'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $data = User::where('name', 'LIKE', '%' . $search . '%')->get();
        $user = auth()->user();
        $roles = Role::whereIn('name', ['admin', 'user'])->get();
        return view('admin-panel.users.index', compact('data', 'user', 'roles'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
