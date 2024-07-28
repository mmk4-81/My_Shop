@extends('layouts.base')

@section('onvan', 'محصولات')

@section('mohtava')

<div class="product-details-area pt-100 pb-95">
    <div class="containers">
        <div class="row">

            <!-- جزئیات محصول -->
            <div class="col-lg-6 col-md-6 order-2 order-sm-2 order-md-1" style="direction: rtl;">
                <div class="product-details-content ml-30">
                    <h2 class="text-right"> {{ $product->name }} </h2>

                    <p class="text-right">
                        {{ $product->description }}
                    </p>
                    <div class="pro-details-meta">
                        <span>فروشگاه :</span>
                        <a href="#">{{ $product->getShopName() }}</a>
                    </div>
                    <div class="pro-details-list text-right">
                        @foreach ($product->attributes()->with('attribute')->get() as $attribute)
                            <p> - {{ $attribute->attribute->name }} : {{ $attribute->value }}</p>
                        @endforeach
                    </div>

                    <div class="pro-details-meta">
                        <span>دسته بندی :</span>
                        @if($product->category && $product->category->parent)
                            {{ $product->category->parent->category_name }}، {{ $product->category->category_name }}
                        @else
                            دسته بندی مشخص نیست
                        @endif
                    </div>

                    @if($product->quantity_check)
                        @php
                            $variationProductSelected = $product->price_check;
                        @endphp
                        <div class="pro-details-size-color text-right">
                            <div class="pro-details-size w-50">
                                <span class="var">{{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}</span>
                                <select class="form-control variation-select">
                                    @foreach ($product->variations()->where('quantity', '>', 0)->get() as $variation)
                                        <option
                                            value="{{ json_encode($variation->only(['id', 'quantity', 'price'])) }}"
                                            {{ $variationProductSelected->id == $variation->id ? 'selected' : '' }}
                                        >{{ $variation->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="product-details-price variation-price">
                            <span class="new">
                                {{ number_format($product->price_check->price) }} تومان
                            </span>
                            <span class="quantity">تعداد :
                                {{ number_format($product->price_check->quantity) }}
                            </span>
                        </div>

                        <div class="pro-details-quality">
                            <div class="pro-details-cart">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="variation" value="{{ json_encode($variationProductSelected) }}">
                                    <input type="number" name="qtybutton" class="cart-plus-minus-box quantity-input" value="1" min="1" max="{{ $variationProductSelected->quantity }}">
                                    <button type="submit" class="btn btn-primary p-3">افزودن به سبد خرید</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="not-in-stock">
                            <p class="text-white">ناموجود</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- تصاویر محصول -->
            <div class="col-lg-6 col-md-6 order-1 order-sm-1 order-md-2">
                <div class="product-details-img">
                    <div class="zoompro-border zoompro-span">
                        <img class="zoompro" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                            data-zoom-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}" alt="" />
                    </div>
                    <div id="gallery" class="mt-20 product-dec-slider">
                        <a data-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                            data-zoom-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}">
                            <img width="90px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}" alt="">
                        </a>
                        @foreach ($product->images as $image)
                            <a data-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                data-zoom-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}">
                                <img width="90px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}" alt="">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.variation-select').on('change', function() {
        let variation = JSON.parse(this.value);
        let variationPriceDiv = $('.variation-price');
        variationPriceDiv.empty();

        let spanPrice = $('<span />', {
            class: 'new',
            text: number_format(variation.price) + ' تومان'
        });

        let spanQuantity = $('<span />', {
            class: 'quantity',
            text: number_format(variation.quantity) + ' تعداد'
        });

        variationPriceDiv.append(spanPrice);
        variationPriceDiv.append(spanQuantity);

        $('.quantity-input').attr('data-max', variation.quantity);
        $('.quantity-input').val(1);
    });

    function number_format(number) {
        return new Intl.NumberFormat().format(number);
    }

    function toPersianNum(number) {
        const persianNumbers = [
            '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'
        ];
        return number.toString().replace(/\d/g, function(d) {
            return persianNumbers[d];
        });
    }
</script>
@endsection
