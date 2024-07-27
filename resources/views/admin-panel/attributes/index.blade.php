@extends('layouts.dashboard')

@section('onvan', 'ویژگی ها')
@section('page-title', 'ویژگی ها')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="d-flex justify-content-between mb-4">
        <h5 class="font-weight-bold">لیست ویژگی ها ({{ $attributes->total() }})</h5>
        <a class="btn btn-sm btn-danger" href="{{ route('admin.attributes.create') }}">
            <i class="fa fa-plus"></i>
            ایجاد ویژگی
        </a>
    </div>

    <div>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attributes as $key => $attribute)
                    <tr>
                        <th>{{ $attributes->firstItem() + $key }}</th>
                        <th>{{ $attribute->name }}</th>
                        <th>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('admin.attributes.show', ['attribute' => $attribute->id]) }}">نمایش</a>
                            <a class="btn btn-sm btn-info mr-3"
                                href="{{ route('admin.attributes.edit', ['attribute' => $attribute->id]) }}">ویرایش</a>
                            <form action="{{ route('admin.attributes.destroy', ['attribute' => $attribute->id]) }}" method="POST" style="display:inline;" id="delete-form-{{ $attribute->id }}">
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
    {{$attributes->render()}}
</div>
@endsection


