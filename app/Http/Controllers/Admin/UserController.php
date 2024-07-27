<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(4);
        $user = auth()->user();
        $roles = Role::whereIn('name', ['admin', 'user'])->get()->map(function ($role) {
            if ($role->name == 'admin') {
                $role->name = 'ادمین';
            } elseif ($role->name == 'user') {
                $role->name = 'کاربر';
            }
            return $role;
        });
        return view('admin-panel.users.index', compact('users', 'roles', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = User::with('roles')->get();
        $user = auth()->user();
        return view('admin-panel.users.create', compact('user', 'data'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'credit' => 'required|numeric',
            'role' => 'required|string|in:admin,user',
            'address' => 'required|string|max:255',
        ]);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->phone = $request->phone;

            if ($request->hasFile('avatar')) {
                $avatarName = time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('uploads/avatars'), $avatarName);
                $user->avatar = $avatarName;
            }

            $user->credit = $request->credit;
            $user->address = $request->address;

            $user->save();


            $role = Role::where('name', $request->role)->first();
            $user->roles()->attach($role->id);


            toastr()->closeButton()->success(' کاربر با موفقیت اضافه شد');
            $users = User::with('roles')->latest()->paginate(5);
            $user = auth()->user();
            $roles = Role::whereIn('name', ['admin', 'user'])->get();
            return view('admin-panel.users.index', compact('users', 'roles', 'user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطایی در ذخیره کاربر رخ داده است.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);

        return view('admin-panel.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();

        if ($user) {
            return view('admin-panel.users.edit', compact('user', 'roles'));
        } else {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }
    }


    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('uploads/avatars'), $avatarName);
                $user->avatar = $avatarName;
            }

            $user->save();
            toastr()->closeButton()->success(' کاربر با موفقیت ویرایش شد');

            return redirect('admin-panel/users');
        } else {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->avatar) {
                $avatarPath = public_path('uploads/avatars/' . $user->avatar);
                if (file_exists($avatarPath)) {
                    unlink($avatarPath);
                }
            }

            $user->roles()->detach();

            $user->delete();

            toastr()->closeButton()->success('کاربر با موفقیت حذف شد');

            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }
    }

    public function updateCredit(Request $request, $id)
    {
        $request->validate([
            'credit' => 'required|numeric|min:0',
        ]);

        $user = User::findOrFail($id);
        $user->credit = $request->input('credit');
        $user->save();

        toastr()->closeButton()->success('اعتبار کاربر با موفقیت به‌روزرسانی شد');
        return redirect()->back();
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        $currentRoles = $user->roles->pluck('id')->toArray();

        $newRoleId = $request->input('role_id');

        if ($newRoleId == 1 || $newRoleId == 2) {
            if (in_array(3, $currentRoles)) {
                $user->roles()->sync([$newRoleId, 3]);
            } else {
                $user->roles()->sync([$newRoleId]);
            }

            toastr()->closeButton()->success('نقش کاربر با موفقیت به‌روزرسانی شد');
        } else {
            toastr()->closeButton()->error('نقش انتخاب شده معتبر نیست');
        }

        return redirect()->back();
    }



}
