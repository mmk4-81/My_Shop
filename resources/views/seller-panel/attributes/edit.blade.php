@extends('layouts.dashboard')

@section('onvan', ' ویرایش ویژگی  ')




@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5 ">
    <div class="mb-4">
    <h5 class="font-weight-bold">ویرایش ویژگی {{ $attribute->name }}</h5>
    </div>
    <hr>


    <form action="{{ route('seller.attributes.update' , ['attribute' => $attribute->id]) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="name" type="text" value="{{ $attribute->name }}">
            </div>
        </div>

        <button class="btn btn-success mt-5" type="submit">ویرایش</button>
        <a href="{{ route('seller.attributes.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
    </form>
</div>
@endsection
