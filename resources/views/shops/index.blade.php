@extends('layouts.base')

@section('onvan', 'صفحه‌ی فروشگاه‌ها')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('mohtava')

<h2 class="title-all">همه‌ی فروشگاه‌ها</h2>

<div class="div_search">
    <p>برای یافتن فروشگاه مورد نظر خود جستجو کنید:</p>
    <form action="{{ route('shops.search') }}" method="get">
        <input type="search" name="search" placeholder="نام فروشگاه">
        <input type="submit" value="جستجو" class="btn btn-primary mx-1">
    </form>
</div>

{{-- <div class="followed-shops-link">
    <a href="{{ route('shops.followed') }}" class="btn btn-info followd">فروشگاه‌های دنبال شده</a>
</div> --}}

<div class="store-roww">
    @foreach ($shops as $shop)
    <div class="store_card_item">
        <img src="{{ asset('/uploads/avatars/shops/' . $shop->avatar_shops) }}" class="store_img" alt="{{ $shop->shop_name }}" />
        <div class="store_card_details">
            <div class="store_card_name">
                <i class="fas fa-shop icons"></i> {{ $shop->shop_name }}
            </div>
            <div class="button-shop">
                @if (in_array($shop->id, $followedShops))
                    <form action="{{ route('shops.unfollow', ['shop' => $shop->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="follow">لغو دنبال کردن</button>
                    </form>
                @else
                    <form action="{{ route('shops.follow', ['shop' => $shop->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="follow">دنبال کردن</button>
                    </form>
                @endif
                <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="visit_button">
                    <button class="visit">مشاهده فروشگاه</button>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if ($shops->isEmpty())
    <p>هیچ فروشگاهی یافت نشد.</p>
@endif

@endsection
