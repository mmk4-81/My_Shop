@extends('layouts.dashboard')

@section('onvan', 'نمایش محصولات')
@section('page-title', 'نمایش محصولات')
@section('role', $user->hasRole('admin') ? 'ادمین ' : 'فروشنده ')
@section('user-role', $user->hasRole('admin') ? 'ادمین سایت' : 'فروشنده سایت')

@section('page-content')
<div class="div_search">
    <form action="{{url('/admin/search_product')}}" method="get">
        <input type="search" name="search">
        <input type="submit" value="جستجو" class="btn btn-primary mx-1">
    </form>
</div>
@endsection

@section('mohtava')
<div>
    <div class="div_deg">
        <form action="{{ url('/admin/update_products/' . $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="group">
                <label for="title">نام محصول</label>
                <input type="text" id="title" name="title" value="{{$data->name}}" required>
            </div>
            <div class="group">
                <label for="text">توضیحات محصول</label>
                <textarea name="description" id="text" cols="30" rows="8" >{{$data->description}}</textarea>
            </div>
            <div >
                <label for="img">عکس محصول</label>
                <img src="{{ asset('/uploads/products/' . $data->primary_image) }}" height="100px" alt="">
                <input type="file" name="image" id="img" >
            </div>
            {{-- <div >
                <label for="category"> دسته بندی محصولات</label>
                <select name="category" id="category">
                    @foreach ($category as $category )

                    <option value="">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div> --}}

            <input type="submit" value=" ویرایش محصول" class="btn btn-success">
        </form>
    </div>
</div>

</div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmation(event) {
            event.preventDefault();
            var urlToDirect = event.target.getAttribute('href');
            Swal.fire({
                title: 'آیا از حذف مطمئن هستید؟',
                text: 'این   محصول برای همیشه حذف خواهد شد',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف کن',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToDirect;
                }
            });
        }
    </script>
