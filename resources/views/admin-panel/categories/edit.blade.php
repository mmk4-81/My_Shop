@extends('layouts.dashboard')

@section('onvan', 'ویرایش دسته بندی  ')
{{-- @section('page-title', '  ویژگی ها') --}}
{{-- @section('role', $user->hasRole('admin') ? 'ادمین ' : 'فروشنده ')
@section('user-role', $user->hasRole('admin') ? 'ادمین سایت' : 'فروشنده سایت') --}}



@section('mohtava')

<div class="col-xl-12 col-md-12 mb-4 p-md-5 ">
    <div class="mb-4">
        <h5 class="font-weight-bold">ویرایش دسته بندی : {{ $category->category_name }}</h5>
    </div>
    <hr>


    <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="name" type="text" value="{{ $category->category_name }}">
            </div>

            <div class="form-group col-md-3">
                <label for="slug">نام انگلیسی</label>
                <input class="form-control" id="slug" name="slug" type="text" value="{{ $category->slug }}">
            </div>

            <div class="form-group col-md-3">
                <label for="parent_id">والد</label>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="0">بدون والد</option>
                    @foreach ($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->id }}" {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                            {{ $parentCategory->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group col-md-3">
                <label for="is_active">وضعیت</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $category->getRawOriginal('is_active') ? 'selected' : '' }}>فعال</option>
                    <option value="0" {{ $category->getRawOriginal('is_active') ? '' : 'selected' }}>غیرفعال</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="attribute_ids">ویژگی</label>
                <select id="attributeSelect" name="attribute_ids[]" class="form-control" multiple
                    data-live-search="true">
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}"
                            {{ in_array($attribute->id , $category->attributes()->pluck('id')->toArray()) ? 'selected' : '' }}
                            >{{ $attribute->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="attribute_is_filter_ids">انتخاب ویژگی های قابل فیلتر</label>
                <select id="attributeIsFilterSelect" name="attribute_is_filter_ids[]" class="form-control" multiple
                    data-live-search="true">
                    @foreach ($category->attributes()->wherePivot('is_filter', 1)->get() as $attribute)
                        <option value="{{ $attribute->id }}" selected>{{ $attribute->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="variationSelect">انتخاب ویژگی متغیر</label>
                <select id="variationSelect" name="variation_id" class="form-control" data-live-search="true">
                    @foreach ($category->attributes as $attribute)
                        <option value="{{ $attribute->id }}" {{ $attribute->pivot->is_variation ? 'selected' : '' }}>{{ $attribute->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group col-md-3">
                <label for="icon">آیکون</label>
                <input class="form-control" id="icon" name="icon" type="text" value="{{ $category->icon }}">
            </div>

            <div class="form-group col-md-12">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description"
                    name="description">{{ $category->description }}</textarea>
            </div>

        </div>

        <button class="btn btn-success mt-5" type="submit">ویرایش</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
    </form>
</div>


@endsection