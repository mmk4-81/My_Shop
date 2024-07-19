<div class="container-categories">

    <div class="category-row mt-1">
        @php
            $categories = [
                ['img' => asset('image/category/Men.webp'), 'title' => 'مردانه'],
                ['img' => asset('image/category/Kids.webp'), 'title' => 'بچگانه'],
                ['img' => asset('image/category/Women.webp'), 'title' => 'زنانه']
            ];
        @endphp
                <h3 class="title-categories">دسته بندی ها</h3>

        @foreach ($categories as $category)
            <div class="card category-card">
                <img class="card-img-top" src="{{ $category['img'] }}" alt="{{ $category['title'] }}">
                <div class="card-body">
                    <h5 class="card-title category-title">{{ $category['title'] }}</h5>
                </div>
            </div>
        @endforeach
    </div>
</div>
