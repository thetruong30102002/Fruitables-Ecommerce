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
    <form action="/sale" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên khuyến mãi</label>
            <input type="text" class="form-control" name='sales_name' value="{{old('sales_name')}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Code khuyến mãi</label>
            <input type="text" class="form-control" name='sales_code' value="{{old('sales_code')}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">% khuyến mãi</label>
            <input type="text" class="form-control" name='sales_discount' value="{{old('sales_discount')}}">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Thêm mới</button>
    </form>
@endsection
