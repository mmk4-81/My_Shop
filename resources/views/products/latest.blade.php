@push('styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

<div class="d-flex justify-content-between align-items-center my-4">
    <p>جدیدترین محصولات</p>
    <a href="{{ url('/all-latest-products') }}" class="btn btn-primary">مشاهده همه</a>
</div>
<div class="product-slider">
    @foreach ($products as $product)
        <div class="product-card" >
            {{-- <img src="{{ asset($product->img) }}" class="img-fluid img" alt="{{ $product->name }}"> --}}
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                {{-- <p class="card-text">{{ $product->price }} تومان</p> --}}
            </div>
        </div>
    @endforeach
</div>


@push('scripts')
<script>
    $(document).ready(function(){
        $('.product-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>
@endpush
