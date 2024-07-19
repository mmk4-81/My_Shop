<div class="store_section">
    <h1 class="shop_section_title">
        فروشگاه‌های پیشنهادی با بهترین قیمت‌ها و تخفیف‌های ویژه
    </h1>
    <a href="pages/stores/all-stores.html" class="visit_all">مشاهده همه</a>
    <div class="store-row">
        <div class="store_list">
            {{-- @foreach () --}}
            <div class="store_card_item">
                <img
                    src="{{asset('/uploads/stores/s1.jpg')}}"
                    class="store_img"
                    alt=" 1"
                />
                <div class="store_card__details">
                    <div class="store_card_name">
                        <i class="fas fa-store icons"></i> فروشگاه آشا
                    </div>
                    <a href="pages/stores/store.html" class="visit_button">
                        <button class="visit">مشاهده فروشگاه</button>
                    </a>
                </div>
            </div>
            <div class="store_card_item">
                <img
                src="{{asset('uploads/stores/s2.jpg')}}"
                class="store_img"
                    alt="فروشگاه 2"
                />
                <div class="store_card__details">
                    <div class="store_card_name">
                        <i class="fas fa-store icons"></i> فروشگاه بوتیک سفید
                    </div>
                    <a href="pages/stores/store.html" class="visit_button">
                        <button class="visit">مشاهده فروشگاه</button>
                    </a>
                </div>
            </div>
            <div class="store_card_item">
                <img
                src="{{asset('uploads/stores/s3.jpg')}}"
                class="store_img"
                    alt="فروشگاه 3"
                />
                <div class="store_card__details">
                    <div class="store_card_name">
                        <i class="fas fa-store icons"></i> فروشگاه استار استور
                    </div>
                    <a href="pages/stores/store.html" class="visit_button">
                        <button class="visit">مشاهده فروشگاه</button>
                    </a>
                </div>
            </div>
            <div class="store_card_item">
                <img
                src="{{asset('uploads/stores/s4.jpg')}}"
                class="store_img"
                    alt="فروشگاه 4"
                />
                <div class="store_card__details">
                    <div class="store_card_name">
                        <i class="fas fa-store icons"></i> فروشگاه دژاوو
                    </div>
                    <a href="pages/stores/store.html" class="visit_button">
                        <button class="visit">مشاهده فروشگاه</button>
                    </a>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
    </div>
</div>
