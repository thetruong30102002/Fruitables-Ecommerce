@extends('backend.dashboard.layout')
@section('layout-backend')
    <h1 class="mt-4">{{ $title }}</h1>
    <div class="col text-right ">
        <a href="category/create" class="btn btn-danger"><i class="fa-solid fa-user-plus"></i> Thêm mới
            danh mục</a>
    </div>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>Name</strong></th>
                <th scope="col" class="text-center"><strong> Thao tác</strong></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($categories) && is_object($categories))
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <div class="user-item email"><strong>{{ $category->id }}</strong> </div>
                        </td>
                        <td>
                            <div class="user-item name"><strong> {{ $category->category_name }}</strong></div>
                        </td>
                        <td class="text-center">
                            <a href="/category/{{ $category->id }}/edit" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <div class="col-3" style="display: inline-block">
                                <form action="/category/{{ $category->id }}" method="post">
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
    {{ $categories->render('name') }}
@endsection
