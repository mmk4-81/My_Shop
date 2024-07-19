<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function view_users()
    {
        $data = User::with('roles')->get();
        $user = auth()->user();

        $roles = Role::whereIn('name', ['admin', 'user'])->get();

        return view('admin.users.view_users', compact('data', 'user', 'roles'));
    }




    // public function search_user(Request $request)
    // {
    //     $search = $request->search;
    //     $data = User::where('name', 'LIKE', '%' . $search . '%')->get();
    //     $user = auth()->user();
    //     $roles = Role::whereIn('name', ['admin', 'user'])->get();
    //     return view('/admin/users/view_users', compact('data', 'user', 'roles'));
    // }

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

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->avatar) {
                $avatarPath = public_path('uploads/avatars/' . $user->avatar);
                if (file_exists($avatarPath)) {
                    unlink($avatarPath);
                }
            }

            $user->delete();
            toastr()->closeButton()->success('کاربر با موفقیت حذف شد');

            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }
    }

    public function showAddUserForm()
    {
        $data = User::with('roles')->get();
        $user = auth()->user();
        return view('admin.users.show_add_user_form',compact('user','data'));
    }

    public function storeUser(Request $request)
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
            $user->password = Hash::make($request->password);
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
            return redirect('/admin/view_users');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطایی در ذخیره کاربر رخ داده است.');
        }
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        if ($user) {
            return view('admin.users.edit_user', compact('user', 'roles'));
        } else {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }
    }


    public function updateUser(Request $request, $id)
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

            return redirect('/admin/view_users')->with('success', 'کاربر با موفقیت ویرایش شد.');
        } else {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }
    }
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        $user->roles()->detach();

        $user->roles()->attach($request->input('role_id'));

        toastr()->closeButton()->success('نقش کاربر با موفقیت به‌روزرسانی شد');
        return redirect()->back();
    }




}
