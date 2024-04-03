@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>Tên người đặt hàng</strong></th>
                <th scope="col"><strong>Địa chỉ</strong></th>
                <th scope="col"><strong>Số điện thoại</strong></th>
                <th scope="col"><strong>Email</strong></th>
                <th scope="col"><strong>Ngày đặt hàng</strong></th>
                <th scope="col"><strong>Tổng</strong></th>
                <th scope="col" class="text-center"><strong> Thao tác</strong></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($orders) && is_object($orders))
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <div class="user-item email"><strong>{{ $order->id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $order->name }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $order->address }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $order->phone }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $order->email }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ date("H:i:s d-m-Y", strtotime($order->order_date)) }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $order->total_amount }}$</strong></div>
                        </td>
                        <td class="text-center">
                            <a href="/order/{{ $order->id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-calendar-week"></i></a>
                            <a href="/generate-pdf/{{ $order->id }}" class="btn btn-danger"><i
                                    class="fa-solid fa-print"></i></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
    {{-- {{ $categories->links() }} --}}
    {{ $orders->render('name') }}
@endsection
