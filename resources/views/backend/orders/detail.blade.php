@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>Order_id ID</strong></th>
                <th scope="col"><strong>Product</strong></th>
                <th scope="col"><strong>Quantity</strong></th>
                <th scope="col"><strong>Unit Price</strong></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($order_detail) && is_object($order_detail))
                @foreach ($order_detail as $detail)
                    <tr>
                        <td>
                            <div class="user-item email"><strong>{{ $detail->id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $detail->order_id }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $detail->product_id }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $detail->quantity }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> ${{ $detail->unit_price}}</strong></div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
    {{-- {{ $categories->links() }} --}}
    {{-- {{ $order_detail->render('name') }} --}}
@endsection
