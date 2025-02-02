@extends('layouts.dashboard')

@section('onvan', 'نمایش دسته بندی  ')




@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="mb-4">
        <h5 class="font-weight-bold">دسته بندی : {{ $category->category_name }}</h5>
    </div>
    <hr>

    <div class="row">
        <div class="form-group col-md-3">
            <label>نام</label>
            <input class="form-control" type="text" value="{{ $category->category_name }}" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>نام انگلیسی</label>
            <input class="form-control" type="text" value="{{ $category->slug }}" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>والد</label>
            <div class="form-control div-disabled">
                @if ($category->parent_id == 0)
                   بدون والد
                @else
                    {{ $category->parent-> category_name }}
                @endif
            </div>
        </div>

        <div class="form-group col-md-3">
            <label>وضعیت</label>
            <input class="form-control" type="text" value="{{ $category->is_active }}" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>آیکون</label>
            <input class="form-control" type="text" value="{{ $category->icon }}" disabled>
        </div>

        <div class="form-group col-md-3">
            <label>تاریخ ایجاد</label>
            <input class="form-control" type="text" value="{{ verta($category->created_at) }}" disabled>
        </div>

        <div class="form-group col-md-12">
            <label>توضیحات</label>
            <textarea class="form-control" disabled>{{ $category->description }}</textarea>
        </div>

        <div class="col-md-12">
            <hr>

            <div class="row">

                <div class="col-md-3">
                    <label>ویژگی ها</label>
                    <div class="form-control div-disabled">
                        @foreach ($category->attributes as $attribute)
                            {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                        @endforeach
                    </div>
                </div>

                <div class="col-md-3">
                    <label>ویژگی های قابل فیلتر</label>
                    <div class="form-control div-disabled">
                        @foreach ($category->attributes()->wherePivot('is_filter' , 1)->get() as $attribute)
                            {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                        @endforeach
                    </div>
                </div>

                <div class="col-md-3">
                    <label>ویژگی متغیر</label>
                    <div class="form-control div-disabled">
                        @foreach ($category->attributes()->wherePivot('is_variation' , 1)->get() as $attribute)
                            {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger mt-5">بازگشت</a>

</div>

@endsection
