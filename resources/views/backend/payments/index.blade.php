@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>OrderID</strong></th>
                <th scope="col"><strong>PaymentDate</strong></th>
                <th scope="col"><strong>paymentMethod</strong></th>
                <th scope="col"><strong>AmountPaid</strong></th>
                <th scope="col" class="text-center"><strong> Thao tác</strong></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($payments) && is_object($payments))
                @foreach ($payments as $payment)
                    <tr>
                        <td>
                            <div class="user-item email"><strong>{{ $payment->id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $payment->order_id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $payment->payment_date }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $payment->payment_method }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item email"><strong>{{ $payment->amount_paid }}</strong> </div>
                        </td>
                        <td class="text-center">
                            <a href="/sale/{{ $sale->id }}/edit" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
    {{-- {{ $categories->links() }} --}}
    {{ $payments->render('name') }}
@endsection
