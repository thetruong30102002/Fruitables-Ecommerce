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
    <form action="/product" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name='product_name' value="{{ old('product_name') }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Giá</label>
            <input type="text" class="form-control" name='price' value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Ảnh</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số lượng</label>
            <input type="number" class="form-control" name='stock_quantity' value="{{ old('stock_quantity') }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Thể loại</label>
            <select name="category_id" class="form-control">
                <option value="0" selected>[--Chọn danh mục sản phẩm--]</option>
                @foreach ($categories as $categogy)
                    <option value="{{ $categogy->id }}">{{ $categogy->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ghi chú</label>
            <textarea type="text" class="form-control" name='description' value="{{ old('description') }}" style="height:100px">
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Thêm mới</button>
    </form>
@endsection
