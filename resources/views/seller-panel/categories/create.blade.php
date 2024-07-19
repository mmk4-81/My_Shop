@extends('layouts.dashboard')

@section('onvan', ' دسته بندی ها ')
@section('page-title', 'ایجاد دسته بندی')
{{-- @section('role', $user->hasRole('seller') ? 'فروشنده ' : 'ادمین ') --}}



@section('mohtava')

<div class="col-xl-12 col-md-12 mb-4 p-md-5">

    <form action="{{ route('seller.categories.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">نام</label>
            <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
            </div>

            <div class="form-group col-md-4">
                <label for="parent_id">والد</label>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="0" class="bg-dark text-white">بدون والد</option>
                    @foreach ($parentCategories as $parentCategory)
                        <option class=" text-white" value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="is_active">وضعیت</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" selected>فعال</option>
                    <option value="0">غیرفعال</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="attribute_ids">ویژگی</label>
                <select id="attributeSelect" name="attribute_ids[]" class="form-control" multiple
                    data-live-search="true">
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="attribute_is_filter_ids">انتخاب ویژگی های قابل فیلتر</label>
                <select id="attributeIsFilterSelect" name="attribute_is_filter_ids[]" class="form-control" multiple
                    data-live-search="true">
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="attribute_is_filter_ids">انتخاب ویژگی متغیر</label>
                <select id="variationSelect" name="variation_id" class="form-control" data-live-search="true">
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="icon">آیکون</label>
                <input class="form-control" id="icon" name="icon" type="text" value="{{ old('icon') }}">
            </div>

            <div class="form-group col-md-12">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

        </div>

        <button class="btn btn-success mt-5" type="submit">ثبت</button>
        <a href="{{ route('seller.categories.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
    </form>
</div>


@endsection


