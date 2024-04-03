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
    <form action="/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3  mt-4">
            <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name='product_name' value="{{ $product->product_name }}">
        </div>
        <div class="mb-3  mt-4">
            <label for="exampleInputEmail1" class="form-label">Giá</label>
            <input type="number" class="form-control" name='price' value="{{ $product->price }}">
        </div>
        <div class="mb-3 mt-4">
            <img src="{{ asset('storage/products/' . $product->image . '') }}" alt="" width="300px">
            <label for="formFile" class="form-label mt-4">Ảnh</label>
            <input class="form-control" type="file" id="formFile" name="image" value="{{old('image')}}">
        </div>
        <div class="mb-3  mt-4">
            <label for="exampleInputEmail1" class="form-label">Số lượng</label>
            <input type="number" class="form-control" name='stock_quantity' value="{{ $product->stock_quantity }}">
        </div>
        <div class="mb-3  mt-4">
            <label for="exampleInputEmail1" class="form-label">Thể loại</label>
            <select name="category_id" class="form-control">
                <option value="0" selected>[--Chọn danh mục sản phẩm--]</option>
                @foreach ($categories as $categogy)
                    <option value="{{ $categogy->id }}" @if ($categogy->id == $product->category_id) selected @endif>
                        {{ $categogy->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3  mt-4">
            <label for="exampleInputEmail1" class="form-label">Ghi chú</label>
            <textarea  class="form-control" name='description' value="" style="height:100px">
                {{$product->description}}
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Cập nhật</button>
    </form>
@endsection
