<!-- resources/views/categories.blade.php -->
<div class="container-categories">
    <div class="category-row mt-1">
        @php
            $categories = [
                ['img' => asset('image/category/Men.webp'), 'title' => 'مردانه', 'id' => 1],
                ['img' => asset('image/category/Kids.webp'), 'title' => 'بچگانه', 'id' => 2],
                ['img' => asset('image/category/Women.webp'), 'title' => 'زنانه', 'id' => 3]
            ];
        @endphp

        <h3 class="title-categories">دسته بندی ها</h3>

        @foreach ($categories as $category)
            <div class=" category-card">
                <a style="text-decoration: none" href="{{ route('home.category.show', ['category' =>$category['title']]) }}" class="card category-card">
                    <img class="card-img-top " src="{{ $category['img'] }}" alt="{{ $category['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title category-title">{{ $category['title'] }}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>


