@extends('layouts.base')

@section('onvan', 'صفحه اصلی ')


@section('mohtava')

@include('home.header')
@include('home.categories')
@include('home.product')
@include('home.shops')
{{-- @include('products.latest') --}}
@endsection
