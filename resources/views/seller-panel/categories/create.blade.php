@extends('layouts.dashboard')

@section('onvan', ' دسته بندی ها ')
@section('page-title', 'ایجاد دسته بندی')



@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <form action="{{ route('seller.categories.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="category_name" type="text" value="{{ old('name') }}">
            </div>

            <div class="form-group col-md-4">
                <label for="parent_id">والد</label>
                <select class="form-control selectpicker" id="parent_id" name="parent_id" data-live-search="true">
                    <option value="0" class="bg-dark">بدون والد</option>
                    @foreach ($parentCategories as $parentCategory)
                        @if($parentCategory->parent_id == 0)
                            <option class="text-white" value="{{ $parentCategory->id }}">{{ $parentCategory->category_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="is_active">وضعیت</label>
                <select class="form-control selectpicker" id="is_active" name="is_active" data-live-search="true">
                    <option value="1" selected>فعال</option>
                    <option value="0">غیرفعال</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="attribute_ids">ویژگی</label>
                <select id="attributeSelect" name="attribute_ids[]" class="form-control selectpicker" multiple data-live-search="true">
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="attribute_is_filter_ids">انتخاب ویژگی های قابل فیلتر</label>
                <select id="attributeIsFilterSelect" name="attribute_is_filter_ids[]" class="form-control selectpicker" multiple data-live-search="true">
                  </select>
            </div>

            <div class="form-group col-md-4">
                <label for="variation_id">انتخاب ویژگی متغیر</label>
                <select id="variationSelect" name="variation_id" class="form-control selectpicker" data-live-search="true">
              </select>
            </div>

            {{-- <div class="form-group col-md-12">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div> --}}
        </div>

        <button class="btn btn-success mt-5" type="submit">ثبت</button>
        <a href="{{ route('seller.categories.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
    </form>
</div>
@endsection




@section('script')
    <script>
        $('#attributeSelect').selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $('#attributeSelect').on('changed.bs.select', function() {
            let attributesSelected = $(this).val();
            let attributes = @json($attributes);

            let attributeForFilter = [];

            attributes.map((attribute) => {
                $.each(attributesSelected , function(i,element){
                    if( attribute.id == element ){
                        attributeForFilter.push(attribute);
                    }
                });
            });

            $("#attributeIsFilterSelect").find("option").remove();
            $("#variationSelect").find("option").remove();
            attributeForFilter.forEach((element)=>{
                let attributeFilterOption = $("<option/>" , {
                    value : element.id,
                    text : element.name
                });

                let variationOption = $("<option/>" , {
                    value : element.id,
                    text : element.name
                });

                $("#attributeIsFilterSelect").append(attributeFilterOption);
                $("#attributeIsFilterSelect").selectpicker('refresh');

                $("#variationSelect").append(variationOption);
                $("#variationSelect").selectpicker('refresh');
            });


        });

        $("#attributeIsFilterSelect").selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $("#variationSelect").selectpicker({
            'title': 'انتخاب متغیر'
        });

    </script>
@endsection



