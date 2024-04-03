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
    <form action="/banner" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
            <input type="text" class="form-control" name='banner_name' value="{{ old('banner_name') }}">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Ảnh</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Thêm mới</button>
    </form>
@endsection
