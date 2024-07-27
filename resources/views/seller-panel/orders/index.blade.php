@extends('layouts.dashboard')

@section('onvan', 'سفارشات')
@section('page-title', ' سفارشات')

@section('mohtava')

<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="col-xl-12 col-md-12 mb-4 p-4 ">
        <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
            <h5 class="font-weight-bold mb-3 mb-md-0">لیست سفارشات  ({{ $orders->total() }})</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام کاربر</th>
                        <th>وضعیت</th>
                        <th>مبلغ</th>
                        <th>وضعیت پرداخت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <th>
                                {{ $orders->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $order->user->name == null ? 'کاربر' : $order->user->name }}
                            </th>
                            <th>
                                {{ $order->order_status }}
                            </th>
                            <th>
                                {{ number_format($order->total_amount) }}
                            </th>

                            <th>
                                {{ $order->payment_status }}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-success"
                                        href="{{ route('seller.orders.show', ['order' => $order->id]) }}">نمایش</a>
                            </th>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="div_deg">
    {{$orders->render() }}
</div>

@endsection

