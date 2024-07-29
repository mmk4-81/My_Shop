@extends('layouts.dashboard')

@section('onvan', ' دسته بندی ها ')
@section('page-title', 'دسته بندی ها')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="d-flex justify-content-between mb-4">
        <h5 class="font-weight-bold">لیست دسته بندی ها ({{ $categories->total() }})</h5>
        <a class="btn btn-sm btn-danger" href="{{ route('seller.categories.create') }}">
            <i class="fa fa-plus"></i>
            ایجاد دسته بندی
        </a>
    </div>

    <div>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>نام انگلیسی</th>
                    <th>والد</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <th>{{ $categories->firstItem() + $key }}</th>
                        <th>{{ $category->category_name }}</th>
                        <th>{{ $category->slug }}</th>
                        <th>
                            @if ($category->parent_id == 0)
                                بدون والد
                            @else
                                {{ $category->parent ? $category->parent->category_name : 'والد نامعتبر' }}
                            @endif
                        </th>
                        <th>
                            <span class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                {{ $category->is_active }}
                            </span>
                        </th>
                        <th>
                            <a class="btn btn-sm btn-success" href="{{ route('seller.categories.show', ['category' => $category->id]) }}">نمایش</a>
                            <a class="btn btn-sm btn-info mr-3" href="{{ route('seller.categories.edit', ['category' => $category->id]) }}">ویرایش</a>
                            <form action="{{ route('seller.categories.destroy', ['category' => $category->id]) }}" method="POST" style="display:inline;" id="delete-form-{{ $category->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-warning mr-3" >حذف</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="div_deg">

    {{$categories->render()}}
</div>
@endsection
