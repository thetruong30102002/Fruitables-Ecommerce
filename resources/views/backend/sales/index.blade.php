@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    <div class="col text-right ">
        <a href="sale/create" class="btn btn-danger"><i class="fa-solid fa-user-plus"></i> Thêm mới
            Mã giảm giá</a>
    </div>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>Name</strong></th>
                <th scope="col"><strong>Code</strong></th>
                <th scope="col"><strong>Discount</strong></th>
                <th scope="col" class="text-center"><strong> Thao tác</strong></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($sales) && is_object($sales))
                @foreach ($sales as $sale)
                    <tr>
                        <td>
                            <div class="user-item email"><strong>{{ $sale->id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $sale->sales_name }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $sale->sales_code }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $sale->sales_discount }}%</strong></div>
                        </td>
                        <td class="text-center">
                            <a href="/sale/{{ $sale->id }}/edit" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <div class="col-3" style="display: inline-block">
                                <form action="/sale/{{ $sale->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Do you want to delete?')"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
    {{-- {{ $categories->links() }} --}}
    {{ $sales->render('name') }}
@endsection
