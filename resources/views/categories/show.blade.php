@extends('layouts.base')

@section('onvan', 'محصولات')


@section('mohtava')


    <div class="container_product">
        <!-- Sidebar -->
        <div class="sidebar-style mr-30">
            <div class="sidebar-widget">
                <h4 class="pro-sidebar-title">جستجو </h4>
                <div class="pro-sidebar-search mb-50 mt-25">
                    <div class="pro-sidebar-search-form">
                        <input id="search-input" type="text" placeholder="... جستجو "
                            value="{{ request()->has('search') ? request()->search : '' }}">
                        <button type="button" onclick="filter()">
                            <i class="sli sli-magnifier"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="sidebar-widget">
                <h4 class="pro-sidebar-title"> دسته بندی </h4>
                <div class="sidebar-widget-list mt-30">
                    <ul>
                        @if ($category->parent)
                            {{ $category->parent->category_name }}
                            @foreach ($category->parent->children as $childCategory)
                                <li>
                                    <a href="{{ route('home.category.show', ['category' => $childCategory->slug]) }}"
                                        style="{{ $childCategory->slug == $category->slug ? 'color: #ff3535' : '' }}">
                                        {{ $childCategory->category_name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <hr>

            @foreach ($attributes as $attribute)
                <div class="sidebar-widget mt-30">
                    <h4 class="pro-sidebar-title"> {{ $attribute->name }} </h4>
                    <div class="sidebar-widget-list mt-20">
                        <ul>
                            @foreach ($attribute->values as $value)
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" class="attribute-{{ $attribute->id }}"
                                            value="{{ $value->value }}" onchange="filter()"
                                            {{ request()->has('attribute.' . $attribute->id) && in_array($value->value, explode('-', request()->attribute[$attribute->id])) ? 'checked' : '' }}>
                                        <a href="#"> {{ $value->value }} </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr>
            @endforeach

            <div class="sidebar-widget mt-30">
                <h4 class="pro-sidebar-title">{{ $variation->name }} </h4>
                <div class="sidebar-widget-list mt-20">
                    <ul>
                        @foreach ($variation->variationValues as $value)
                            <li>
                                <div class="sidebar-widget-list-left">
                                    <input type="checkbox" class="variation" value="{{ $value->value }}"
                                        onchange="filter()"
                                        {{ request()->has('variation') && in_array($value->value, explode('-', request()->variation)) ? 'checked' : '' }}>
                                    <a href="#"> {{ $value->value }} </a>
                                    <span class="checkmark"></span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="shop-top-bar" style="direction: rtl;">

                <div class="select-shoing-wrap">
                    <div class="shop-select">
                        <select id="sort-by" onchange="filter()">
                            <option value="default"> مرتب سازی </option>
                            <option value="max"
                                {{ request()->has('sortBy') && request()->sortBy == 'max' ? 'selected' : '' }}>
                                بیشترین قیمت </option>
                            <option value="min"
                                {{ request()->has('sortBy') && request()->sortBy == 'min' ? 'selected' : '' }}> کم
                                ترین قیمت </option>
                            <option value="latest"
                                {{ request()->has('sortBy') && request()->sortBy == 'latest' ? 'selected' : '' }}>
                                جدیدترین </option>
                            <option value="oldest"
                                {{ request()->has('sortBy') && request()->sortBy == 'oldest' ? 'selected' : '' }}>
                                قدیمی ترین </option>
                        </select>
                    </div>

                </div>


                <div class="row ht-products" style="direction: rtl;">
                    @foreach ($products as $product)
                        <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                            <!--Product Start-->
                            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                <div class="ht-product-inner">
                                    <div class="ht-product-image-wrap">
                                        <a href="" class="ht-product-image">
                                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}" alt="{{ $product->name }}" />
                                        </a>
                                    </div>
                                    <div class="ht-product-content">
                                        <div class="ht-product-content-inner">
                                            <div class="ht-product-categories">
                                                <a href="#">{{ $product->category->category_name }}</a>
                                            </div>
                                            <h4 class="ht-product-title text-right">
                                                <a href="#"> {{ $product->name }} </a>
                                            </h4>
                                            <div class="ht-product-price">
                                                @if($product->quantity_check)
                                                    @if($product->sale_check)
                                                        <span class="new">
                                                            {{ number_format($product->sale_check->sale_price) }}
                                                            تومان
                                                        </span>
                                                        <span class="old">
                                                            {{ number_format($product->sale_check->price) }}
                                                            تومان
                                                        </span>
                                                    @else
                                                        <span class="new">
                                                            {{ number_format($product->price_check->price) }}
                                                            تومان
                                                        </span>
                                                    @endif
                                                @else
                                                    <div class="not-in-stock">
                                                        <p class="text-white">ناموجود</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="pro-details-cart">
                                            <a href="#">افزودن به سبد خرید</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Product End-->
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>



    <form id="filter-form">
        @foreach ($attributes as $attribute)
            <input id="filter-attribute-{{ $attribute->id }}" type="hidden" name="attribute[{{ $attribute->id }}]">
        @endforeach
        <input id="filter-variation" type="hidden" name="variation">
        <input id="filter-sort-by" type="hidden" name="sortBy">
        <input id="filter-search" type="hidden" name="search">
    </form>
@endsection
