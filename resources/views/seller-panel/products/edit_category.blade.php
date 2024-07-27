@extends('layouts.dashboard')

@section('onvan', 'محصولات')
@section('page-title', 'ایجاد محصول')

@section('mohtava')

<div class="col-xl-12 col-md-12 mb-4 p-4">

    <div class="col-xl-12 col-md-12 mb-4 p-4 ">
        <div class="mb-4 text-center text-md-right">
            <h5 class="font-weight-bold">ویرایش دسته بندی محصول : {{ $product->name }}</h5>
        </div>
        <hr>


        <form action="{{ route('seller.products.category.update', ['product' => $product->id]) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-row">

                {{-- Category&Attributes Section --}}

                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="form-group col-md-3">
                            <label for="category_id">دسته بندی</label>
                            <select id="categorySelect" name="category_id" class="form-control" data-live-search="true">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category->id ? 'selected' : '' }}>{{ $category->category_name }} -
                                        {{ $category->parent->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="attributesContainer" class="col-md-12">
                    <div id="attributes" class="row"></div>
                    <div class="col-md-12">
                        <hr>
                        <p>افزودن قیمت و موجودی برای متغیر <span class="font-weight-bold" id="variationName"></span> :
                        </p>
                    </div>

                    <div id="czContainer">
                        <div id="first">
                            <div class="recordset">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>نام</label>
                                        <input class="form-control" name="variation_values[value][]" type="text">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>قیمت</label>
                                        <input class="form-control" name="variation_values[price][]" type="text">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>تعداد</label>
                                        <input class="form-control" name="variation_values[quantity][]" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <button class="btn btn-info mt-5" type="submit">ویرایش</button>
            <a href="{{ route('seller.products.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
        </form>
    </div>

</div>

@endsection

@section('script')
    <script>
        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });

        $('#attributesContainer').hide();

        $('#categorySelect').on('changed.bs.select', function() {
            let categoryId = $(this).val();

            $.get(`{{ url('/seller-panel/category-attributes/${categoryId}') }}`, function(response,
                status) {
                if (status == 'success') {
                    // console.log(response);

                    $('#attributesContainer').fadeIn();

                    // Empty Attribute Container
                    $('#attributes').find('div').remove();

                    // Create and Append Attributes Input
                    response.attrubtes.forEach(attribute => {
                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.name,
                            name: `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);

                    });

                    $('#variationName').text(response.variation.name);

                } else {
                    alert('مشکل در دریافت لیست ویژگی ها');
                }
            }).fail(function() {
                alert('مشکل در دریافت لیست ویژگی ها');
            });
        });

        $("#czContainer").czMore();

    </script>
@endsection
