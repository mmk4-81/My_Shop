{{-- @extends('layouts.dashboard')

@section('onvan', 'ویرایش محصول')
@section('page-title', 'ویرایش محصول')
@section('role', $user->hasRole('admin') ? 'ادمین' : 'فروشنده')
@section('user-role', $user->hasRole('admin') ? 'ادمین سایت' : 'فروشنده سایت')

@section('mohtava')
<div>
    <form action="{{ url('/admin/update_products', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">نام محصول:</label>
            <input type="text" name="name" value="{{ $data->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">توضیحات محصول:</label>
            <textarea name="description" required>{{ $data->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="primary_image">عکس محصول:</label>
            <input type="file" name="primary_image">
            @if ($data->primary_image)
                {{-- <img src="{{ asset('uploads/products/' . $data->primary_image) }}" height="200px" alt="تصویر محصول"> --}}
            @endif
        </div>
        <div class="form-group">
            <label for="is_active">وضعیت محصول:</label>
            <select name="is_active" required>
                <option value="1" {{ $data->is_active ? 'selected' : '' }}>فعال</option>
                <option value="0" {{ !$data->is_active ? 'selected' : '' }}>غیرفعال</option>
            </select>
        </div>
        <input type="submit" value="ذخیره" class="btn btn-primary">
        <a href="{{ url('/admin/view_products') }}" class="btn btn-secondary">لغو</a>
    </form>
</div>
@endsection 
