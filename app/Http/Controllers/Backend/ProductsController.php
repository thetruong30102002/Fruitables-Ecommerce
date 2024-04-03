<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Sản phẩm";
        $products = Product::paginate(15);
        return view('backend.products.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới sản phẩm";
        $categories = Category::All();
        return view('backend.products.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
            'product_name.unique' => 'Bạn nhập trùng tên sản phẩm',
            'price.required' => 'Bạn chưa nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'stock_quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
            'category_id.gt' => 'Bạn chưa chọn danh mục',
            'image.required' => 'Bạn chưa thêm ảnh sản phẩm',
        ];
        $validated = $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required|numeric',
            'image' => 'required',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer|gt:0',
        ], $messages);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('/public/products', $fileName);
            // dd($fileName);
            // //luu
            // if($customer->image){
            //     Storage::delete('./public'.$customer->image);
            // }

        }

        Product::create([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'image' => $fileName,
        ]);
        return  redirect('/product')->with('success','Thêm thành công');;
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
        $title = "Cập nhật sản phẩm";
        $product = Product::find($id);
        $categories = Category::All();
        return view('backend.products.edit', compact('title', 'product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $messages = [
            'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
            'product_name.unique' => 'Bạn nhập trùng tên sản phẩm',
            'price.required' => 'Bạn chưa nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.float' => 'Giá sản phẩm phải là số',
            'stock_quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
            'category_id.gt' => 'Bạn chưa chọn danh mục',
        ];
        $validated = $request->validate([
            'product_name' => 'required|unique:products,product_name,'. $product->id.'',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer|gt:0',
        ], $messages);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('/public/products', $fileName);
            // dd($fileName);
            // //luu
            if($product->image){
                Storage::delete('./public/products'.$product->image);
            }

        }else{
            
            $fileName = $product->image;
        }

        $product->update([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'image' => $fileName,
        ]);
        return  redirect('/product')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->delete();
        return redirect('/product')->with('xóa','Xóa thành công');;
    }
}
