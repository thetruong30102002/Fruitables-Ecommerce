@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/sale/{{ $sale->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Khuyến mãi</label>
            <input type="text" class="form-control" name='sales_name' value="{{$sale->sales_name}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" name='sales_code' value="{{$sale->sales_code}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">% khuyến mãi</label>
            <input type="text" class="form-control" name='sales_discount' value="{{$sale->sales_discount}}">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Cập nhật</button>
    </form>
@endsection
