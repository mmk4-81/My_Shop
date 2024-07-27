@extends('layouts.dashboard')

@section('onvan', '  محصولات')
@section('page-title', 'محصولات')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="col-xl-12 col-md-12 mb-4 p-4">
        <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
            <h5 class="font-weight-bold mb-3 mb-md-0">لیست محصولات ها ({{ $products->total() }})</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام دسته بندی</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <th>
                                {{ $products->firstItem() + $key }}
                            </th>
                            <th>
                                <a href="{{ route('admin.products.show', ['product' => $product->id]) }}">
                                    {{ $product->name }}
                                </a>
                            </th>

                            <th>
                                {{ $product->category->category_name }}
                                @if($product->category->parent)
                                    - {{ $product->category->parent->category_name }}
                                @endif
                            </th>

                            <th>
                                <span
                                    class="{{ $product->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                    {{ $product->is_active }}
                                </span>
                            </th>
                            <th>
                                <form action="{{ route('admin.products.disable', ['product' => $product->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $product->is_active ? 'btn-info' : 'btn-success' }} mr-3">
                                        {{ $product->is_active=="فعال" ? 'غیرفعال کردن' : 'فعال کردن' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-warning mr-3">حذف</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="div_deg">
    {{ $products->render() }}
</div>
@endsection
