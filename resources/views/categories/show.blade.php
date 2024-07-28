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
                            <i onclick="filter()" class="fas fa-magnifying-glass"></i>

                    </div>
                </div>
            </div>
            <div class="sidebar-widget">
                <h4 class="pro-sidebar-title">دسته بندی</h4>
                <div class="sidebar-widget-list mt-30">
                    <ul>
                        @foreach ($parentCategories as $parentCategory)
                        <li>
                            <a href="{{ $parentCategory->slug == $category->slug && $childSlugForUrl ? route('home.category.show', ['category' => $childSlugForUrl]) : '#' }}"
                                style="{{ $parentCategory->slug == $category->slug ? 'color: #ff3535' : '' }}">
                                {{ $parentCategory->category_name }}
                            </a>
                            @if ($parentCategory->children->isNotEmpty())
                                <ul class="submenu">
                                    @foreach ($parentCategory->children as $childCategory)
                                        <li>
                                            <a href="{{ route('home.category.show', ['category' => $childCategory->slug]) }}"
                                                style="{{ $childCategory->slug == $category->slug ? 'color: #ff3535' : '' }}">
                                                {{ $childCategory->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
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
                                                <i class="fas fa-tags icons"></i><a href="#">{{$product->category->category_name }} - {{ $product->category->parent->category_name }}</a>
                                            </div>
                                            <h4 class="ht-product-title text-right">
                                                <a href="#"> {{ $product->name }} </a>
                                            </h4>
                                            <div class="product_info_item money">
                                                @if($product->quantity_check)
                                                    <span class="new">
                                                        <i class="fas fa-money-bill-wave icons"></i>{{ number_format($product->price) }} تومان
                                                    </span>
                                                @else
                                                    <div class="not-in-stock">
                                                        <p class="text-white">ناموجود</p>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                        <a href="{{ route('home.products.show', ['product' => $product->slug]) }}" class="visit_button">
                                            <button class="visit">مشاهده محصول</button>
                                        </a>
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

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
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



@section('script')
    <script>
        function filter() {

            let attributes = @json($attributes);
            attributes.map(attribute => {

                let valueAttribute = $(`.attribute-${attribute.id}:checked`).map(function() {
                    return this.value;
                }).get().join('-');

                if (valueAttribute == "") {
                    $(`#filter-attribute-${attribute.id}`).prop('disabled', true);
                } else {
                    $(`#filter-attribute-${attribute.id}`).val(valueAttribute);
                }

            });

            let variation = $('.variation:checked').map(function() {
                return this.value;
            }).get().join('-');
            if (variation == "") {
                $('#filter-variation').prop('disabled', true);
            } else {
                $('#filter-variation').val(variation);
            }

            let sortBy = $('#sort-by').val();
            if (sortBy == "default") {
                $('#filter-sort-by').prop('disabled', true);
            } else {
                $('#filter-sort-by').val(sortBy);
            }

            let search = $('#search-input').val();
            if (search == "") {
                $('#filter-search').prop('disabled', true);
            } else {
                $('#filter-search').val(search);
            }

            $('#filter-form').submit();
        }

        $('#filter-form').on('submit', function(event) {
            event.preventDefault();
            let currentUrl = '{{ url()->current() }}';
            let url = currentUrl + '?' + decodeURIComponent($(this).serialize())
            $(location).attr('href', url);
        });

        $('.variation-select').on('change' , function(){
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation-price');
            variationPriceDiv.empty();

            if(variation.is_sale){
                let spanSale = $('<span />' , {
                    class : 'new',
                    text : toPersianNum(number_format(variation.sale_price)) + ' تومان'
                });
                let spanPrice = $('<span />' , {
                    class : 'old',
                    text : toPersianNum(number_format(variation.price)) + ' تومان'
                });

                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);
            }else{
                let spanPrice = $('<span />' , {
                    class : 'new',
                    text : toPersianNum(number_format(variation.price)) + ' تومان'
                });
                variationPriceDiv.append(spanPrice);
            }

            $('.quantity-input').attr('data-max' , variation.quantity);
            $('.quantity-input').val(1);

        });

        $('#pagination li a').map(function(){
            let decodeUrl = decodeURIComponent($(this).attr('href'));
            if( $(this).attr('href') !== undefined ){
                $(this).attr('href' , decodeUrl);
            }
        });

    </script>
@endsection
