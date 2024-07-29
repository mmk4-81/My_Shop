@extends('layouts.dashboard')

@section('onvan', ' ویژگی ها ')
@section('page-title', ' ایجاد ویژگی ها')




@section('mohtava')

    <div class="col-xl-12 col-md-12 mb-4 p-md-5">
        <form action="{{ route('admin.attributes.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">نام ویژگی</label>
                    <input class="form-control" id="name" name="name" type="text">
                </div>
            </div>

            <button class="btn btn-success mt-5" type="submit">ثبت</button>
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
        </form>

    </div>

@endsection
