@extends('layouts.dashboard')

@section('onvan', ' نمایش کاربران')
@section('page-title', 'نمایش کاربران')
@section('role', 'ادمین')
@section('user-role', 'ادمین سایت')

@section('page-content')
<div class="div_search">
    <form action="{{ url('/admin/search_user') }}" method="get">
        <input type="search" name="search">
        <input type="submit" value="جستجو" class="btn btn-primary mx-1">
    </form>
</div>
@endsection

@section('mohtava')
<div>
    <div>
        <table class="table_deg">
            <thead>
                <tr>
                    <th> نام کاربر </th>
                    <th> ایمیل </th>
                    <th> تلفن </th>
                    <th> آواتار </th>
                    <th> اعتبار </th>
                    <th> تغییر اعتبار </th>
                    <th> نقش </th>
                    <th> آدرس </th>
                    <th>حذف کاربر</th>
                    <th>ویرایش کاربر</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td><img src="{{ asset('/uploads/avatars/' . $user->avatar) }}" height="100px" alt="آواتار"></td>
                        <td>{{ $user->credit }}</td>
                        <td>
                            <form action="{{ url('/admin/update_credit', $user->id) }}" method="post">
                                @csrf
                                <input type="text" name="credit" value="{{ $user->credit }}" class="credit-input">
                                <input type="submit" value="ذخیره" class="btn btn-success">
                            </form>
                        </td>
                        <td>
                            {{ $user->roles->pluck('name')->join(', ') }}

                            <form action="{{ url('/admin/update_role', $user->id) }}" method="post">
                                @csrf
                                <select name="role_id" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="submit" value="ذخیره" class="btn btn-primary">
                            </form>
                        </td>
                        <td>{{ $user->address }}</td>
                        <td><a href="{{ url('/admin/delete_users', $user->id) }}" class="btn btn-danger" onclick="confirmation(event)">حذف</a></td>
                        <td><a href="{{ url('/admin/edit_user', $user->id) }}" class="btn btn-warning">ویرایش</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmation(event) {
        event.preventDefault();
        var urlToDirect = event.target.getAttribute('href');
        Swal.fire({
            title: 'آیا از حذف مطمئن هستید؟',
            text: 'این کاربر برای همیشه حذف خواهد شد',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله، حذف کن',
            cancelButtonText: 'لغو'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlToDirect;
            }
        });
    }
</script>
