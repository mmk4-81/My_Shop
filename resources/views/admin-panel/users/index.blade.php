@extends('layouts.dashboard')

@section('onvan', 'کاربران')
@section('page-title', 'کاربران')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="d-flex justify-content-between mb-4">
        <h5 class="font-weight-bold">لیست کاربران ({{ $users->total() }})</h5>
        <a class="btn btn-sm btn-danger" href="{{ route('admin.users.create') }}">
            <i class="fa fa-plus"></i>
            ایجاد کاربر
        </a>
    </div>

    <div>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>اعتبار</th>
                    <th>تغییر اعتبار</th>
                    <th>نقش</th>
                    <th>تغییر نقش</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->credit }}</td>
                        <td>
                            <form action="{{ route('admin.users.updateCredit', ['user' => $user->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="text" name="credit" value="{{ $user->credit }}" class="credit-input form-control">
                                <input type="submit" value="ذخیره" class="btn btn-success mt-2">
                            </form>
                        </td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            <form action="{{ route('admin.users.updateRole', ['user' => $user->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <select name="role_id" class="form-control" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="submit" value="ذخیره" class="btn btn-primary mt-2">
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.users.show', ['user' => $user->id]) }}">نمایش</a>
                            <a class="btn btn-sm btn-info my-2" href="{{ route('admin.users.edit', ['user' => $user->id]) }}">ویرایش</a>
                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display:inline;" id="delete-form-{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="div_deg">

            {{ $users->render() }}
        </div>
    </div>
</div>

@endsection
