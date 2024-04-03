<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh mục";
        $categories = Category::paginate(15);
        return view('backend.categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới danh mục";
        return view('backend.categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'category_name.required' => 'Bạn chưa nhập tên danh mục',
            'category_name.unique' => 'Trùng tên danh mục',
        ];
        $validated = $request->validate([
            'category_name' => 'required|unique:categories',
        ], $messages);
        Category::create([
            'category_name' => $request->input('category_name'),
        ]);
        return  redirect('/category')->with('success','Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Cập nhật danh mục";
        $category = Category::find($id);
        return view('backend.categories.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);;
        $messages = [
            'category_name.required' => 'Bạn chưa nhập tên danh mục',
            'category_name.unique' => 'Bạn nhập trùng tên danh mục',
        ];
        $validated = $request->validate([
            'category_name' => 'required|unique:categories,category_name,'. $category->id.'',
        ], $messages);
        $category->update([
            'category_name' => $request->input('category_name'),
        ]);
        return  redirect('/category')->with('success','Cập nhật thành công');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->delete();
        return redirect('/category')->with('Xóa','Thêm thành công');
    }
}
