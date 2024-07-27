@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.dashboard')

@section('onvan', 'فروشگاه ها')
@section('page-title', 'فروشگاه ها')

@section('mohtava')
    <div class="col-xl-12 col-md-12 mb-4 p-md-5">
        <div class="d-flex justify-content-between mb-4">
            <h5 class="font-weight-bold">لیست فروشگاه ها ({{ $shops->total() }})</h5>
        </div>

        <div>
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام صاحب فروشگاه</th>
                        <th>توضیحات</th>
                        <th>آواتار</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shops as $key => $shop)
                        <tr>
                            <th>{{ $shops->firstItem() + $key }}</th>
                            <th>{{ $shop->shop_name }}</th>
                            <td>{{ $shop->user->name }}</td>
                            <th>{{ Str::words($shop->description, 10) }}</th>
                            <td><img src="{{ asset('/uploads/avatars/shops/' . $shop->avatar_shops) }}" height="70px" alt="آواتار"></td>
                            <th>
                                <a class="btn btn-sm btn-success mb-2" href="{{ route('admin.shops.show', ['shop' => $shop->id]) }}">نمایش</a>

                                <form action="{{ route('admin.shops.destroy', ['shop' => $shop->id]) }}" method="POST" style="display:inline;" id="delete-form-{{ $shop->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-warning mr-3">حذف</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="div_deg">
        {{ $shops->links() }}
    </div>
@endsection
