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
    <form action="/banner/{{ $banner->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3  mt-4">
            <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
            <input type="text" class="form-control" name='banner_name' value="{{ $banner->banner_name }}">
        </div>
        <div class="mb-3 mt-4">
            <img src="{{ asset('storage/banners/' . $banner->image . '') }}" alt="" width="300px">
            <label for="formFile" class="form-label mt-4">Ảnh</label>
            <input class="form-control" type="file" id="formFile" name="image" >
        </div>
        <button type="submit" class="btn btn-primary mt-4">Cập nhật</button>
    </form>
@endsection
