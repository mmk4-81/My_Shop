@extends('layouts.base')

@section('onvan', 'فروشگاه‌های دنبال شده')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('mohtava')

<h2 class="title-all">فروشگاه‌های دنبال شده</h2>

<div class="store-row">
    @forelse ($followedShops as $shop)
    <div class="store_card_item">
        <img src="{{ asset('/uploads/avatars/shops/' . $shop->avatar_shops) }}" class="store_img" alt="{{ $shop->shop_name }}" />
        <div class="store_card_details">
            <div class="store_card_name">
                <i class="fas fa-shop icons"></i> {{ $shop->shop_name }}
            </div>
            <div>
                <form action="{{ route('shops.unfollow', ['shop' => $shop->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="follow">لغو دنبال کردن</button>
                </form>
                <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="visit_button">
                    <button class="visit">مشاهده فروشگاه</button>
                </a>
            </div>
        </div>
    </div>
    @empty
    <p>شما هیچ فروشگاهی را دنبال نکرده‌اید.</p>
    @endforelse
</div>

@endsection
