@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    <div class="col text-right ">
        <a href="banner/create" class="btn btn-danger"><i class="fa-solid fa-user-plus"></i> Thêm mới
            banner</a>
    </div>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>Name</strong></th>
                <th scope="col"><strong>Image</strong></th>
                <th scope="col" class="text-center"><strong> Thao tác</strong></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($banners) && is_object($banners))
                @foreach ($banners as $banner)
                    <tr>
                        <td>
                            <div class="user-item email"><strong>{{ $banner->id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $banner->banner_name }}</strong></div>
                        </td>
                        <td>
                            <div class="user-item name"><img src="{{asset('storage/banners/'.$banner->image.'')}}" alt="" width="300"></div>
                        </td>
                        <td class="text-center">
                            <a href="/banner/{{ $banner->id }}/edit" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <div class="col-3" style="display: inline-block">
                                <form action="/banner/{{ $banner->id }}" method="post">
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
    {{ $banners->render('name') }}
@endsection
