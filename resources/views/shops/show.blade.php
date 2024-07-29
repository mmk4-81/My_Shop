@extends('layouts.base')

@section('onvan', 'صفحه ی فروشگاه')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('mohtava')
<div class="shop-details">
    <div class="store_img avatar_shop">
        <img src="{{ asset('/uploads/avatars/shops/' . $shop->avatar_shops) }}" alt="{{ $shop->shop_name }} Avatar">
    </div>

    <div class="shop-info">
        <h3>{{ $shop->shop_name }}</h3>
        <p>{{ $shop->description }}</p>
        <p>صاحب فروشگاه : {{ $shop->user->name }}</p>
        <p>تعداد دنبال‌کننده‌ها: {{ $followersCount }}</p>

        <div class="shop-follow">
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
        </div>
    </div>
</div>

<div class="shop-products">
    <h2>محصولات فروشگاه : {{$products->count()}}</h2>
    <div class="product-row">
        @forelse ($products as $product)
            <div class="product_card_itemm">
                <img src="{{ asset('uploads/files/products/images/' . $product->primary_image) }}" class="product_img" alt="{{ $product->name }}">
                <div class="product_card_details">
                    <div class="product_card_name">
                        <i class="fas fa-tshirt icons"></i> {{ $product->name }}
                    </div>
                    <div class="product_info_items">
                        <div class="product_info_item">
                            <i class="fas fa-tags icons"></i> {{ $product->category->category_name }} - {{ $product->category->parent->category_name }}
                        </div>
                        <div class="money">
                            <div class="product_info_item">
                                <i class="fas fa-money-bill-wave icons"></i> {{ $product->price }} تومان
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('home.products.show', ['product' => $product->slug]) }}" class="visit_button">
                        <button class="visit">مشاهده محصول</button>
                    </a>
                </div>
            </div>
        @empty
            <p>محصولی برای این فروشگاه یافت نشد.</p>
        @endforelse
    </div>
</div>
<div class="d-flex justify-content-center">
    {{$products->links()}}
</div>
@endsection
