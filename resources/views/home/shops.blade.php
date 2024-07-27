<!-- resources/views/shops/index.blade.php -->
<div class="store_section">
    <h1 class="shop_section_title">
        فروشگاه‌های پیشنهادی با بهترین قیمت‌ها و تخفیف‌های ویژه
    </h1>
    <a href="{{url('/shops')}}" class="visit_all">مشاهده همه</a>

    <div id="shopCarousel" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($shops->chunk(4) as $chunk) <!-- Break shops into chunks of 4 for each slide -->
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="store-row ">
                        @foreach ($chunk as $shop)
                            <div class="store_card_item">
                                <img src="{{ asset('/uploads/avatars/shops/' . $shop->avatar_shops) }}" class="store_img" alt="{{ $shop->shop_name }}" />
                                <div class="store_card_details">
                                    <div class="store_card_name">
                                        <i class="fas fa-shop icons"></i> {{ $shop->shop_name }}
                                    </div>
                                    <div>
                                        <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="visit_button">
                                            <button class="visit">مشاهده فروشگاه</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#shopCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#shopCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
