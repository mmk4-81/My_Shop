<!-- resources/views/products/index.blade.php -->
<div class="product_section">
    <h1 class="product_section_title">
        ارائه دهنده لباس‌های متنوع و با قیمت مناسب
    </h1>
    <div id="productCarousel" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($products->chunk(4) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="products-wrapper">
                        @foreach ($chunk as $product)
                            <div class="product_card_itemmm">
                                <img src="{{ asset('uploads/products/' . $product->primary_image) }}" class="product_img" alt="{{ $product->name }}">
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
                                                <i class="fas fa-money-bill-wave icons"></i>  تومان
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" class="visit_button">
                                        <button class="visit">مشاهده محصول</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
