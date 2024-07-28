@extends('layouts.base')

@section('onvan', 'سبدخرید  ')



@section('mohtava')
<div class="container-cart">
    <h2 class="title-cart">سبد خرید</h2>
    @if(session()->has('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>نام محصول</th>
                    <th>قیمت</th>
                    <th>تعداد</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $item)
                    <tr>
                        {{-- <td><a href="{{ route('home.products.show', ['product' => $product->slug]) }}">{{ $item['name'] }}</a></td> --}}
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price']) }} تومان</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="rowId" value="{{ $item['id'] }}">
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>سبد خرید شما خالی است.</p>
    @endif
</div>
@endsection
