@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    <div class="col text-right ">
        <a href="product/create" class="btn btn-danger"><i class="fa-solid fa-user-plus"></i> Thêm mới
            sản phẩm</a>
    </div>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>Name</strong></th>
                <th scope="col"><strong>Image</strong></th>
                <th scope="col"><strong>Price</strong></th>
                <th scope="col"><strong>Quantity</strong></th>
                <th scope="col"><strong>Description</strong></th>
                <th scope="col"><strong>Category</strong></th>
                <th scope="col" class="text-center"><strong> Thao tác</strong></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($products) && is_object($products))
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="user-item email"><strong>{{ $product->id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $product->product_name }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name">
                                <img src="{{asset('storage/products/'.$product->image.'')}}" width="200px">
                            </div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $product->price }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $product->stock_quantity }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $product->description }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $product->category_id }}</strong></div>
                        </td>
                        <td class="text-center">
                            <a href="/product/{{ $product->id }}/edit" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <div class="col-3" style="display: inline-block">
                                <form action="/product/{{ $product->id }}" method="post">
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
    {{ $products->render('name') }}
@endsection
