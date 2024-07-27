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
                        <div class="product-details-price variation-price">
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

                            <p class="text-right">
                                {{ $product->description }}
                            </p>
                        </div>
                        <div class="pro-details-list text-right">
                            <ul>
                                @foreach ($product->attributes()->with('attribute')->get() as $attribute)
                                <li> -
                                    {{ $attribute->attribute->name }}
                                    :
                                    {{ $attribute->value }}
                                </li>
                                @endforeach
                            </ul>

                        </div>

                        @if($product->quantity_check)
                            @php
                                $variationProductSelected = $product->sale_check ?? $product->price_check;
                            @endphp
                            <div class="pro-details-size-color text-right">
                                <div class="pro-details-size w-50">
                                    <span>{{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}</span>
                                    <select class="form-control variation-select">
                                        @foreach ($product->variations()->where('quantity' , '>' , 0)->get() as $variation)
                                            <option
                                                value="{{ json_encode($variation->only(['id' , 'quantity' , 'price'])) }}"
                                                {{ $variationProductSelected->id == $variation->id ? 'selected' : '' }}
                                            >{{ $variation->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box quantity-input" type="number" name="qtybutton" value="1" data-max="5" />
                                </div>
                                <div class="pro-details-cart">
                                    <a href="#">افزودن به سبد خرید</a>
                                </div>
                            </div>
                        @endif

                        <div class="pro-details-meta">
                            <span>دسته بندی :</span>
                            <ul>
                                @if($product->category && $product->category->parent)
                                    <li><a href="#">{{ $product->category->parent->category_name }}، {{ $product->category->category_name }}</a></li>
                                @else
                                    <li>دسته بندی مشخص نیست</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- تصاویر محصول -->
                <div class="col-lg-6 col-md-6 order-1 order-sm-1 order-md-2">
                    <div class="product-details-img">
                        <div class="zoompro-border zoompro-span">
                            <img   class="zoompro" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
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
    </script>
@endsection
