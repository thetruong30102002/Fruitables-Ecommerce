<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Mã khuyễn mãi";
        $sales = Sale::paginate(15);
        return view('backend.sales.index', compact('title', 'sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới khuyến mãi";
        return view('backend.sales.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'sales_name.required' => 'Bạn chưa nhập tên khuyến mãi',
            'sales_name.unique' => 'Trùng tên khuyến mãi',
            'sales_code.required' => 'Bạn chưa nhập mã khuyến mãi',
            'sales_code.unique' => 'Trùng mã khuyến mãi',
            'sales_discount.required' => 'Bạn chưa nhập phần trăm khuyến mãi',
            'sales_discount.integer' => 'Phần trăm khuyến mãi phải là số',
            'sales_discount.integer' => 'Phần trăm khuyến mãi phải là số',
            'sales_discount.between' => 'Phần trăm khuyến mãi 1-99',
        ];
        $validated = $request->validate([
            'sales_name' => 'required|unique:sales',
            'sales_code' => 'required|unique:sales',
            'sales_discount' => 'required|integer|between:1,99',
        ], $messages);
        Sale::create([
            'sales_name' => $request->input('sales_name'),
            'sales_code' => $request->input('sales_code'),
            'sales_discount' => $request->input('sales_discount'),
        ]);
        return  redirect('/sale')->with('success','Thêm thành công');
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
        $title = "Cập nhật khuyến mãi";
        $sale = Sale::find($id);
        return view('backend.sales.edit', compact('title', 'sale'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sale = Sale::find($id);;
        $messages = [
            'sales_name.required' => 'Bạn chưa nhập tên khuyến mãi',
            'sales_name.unique' => 'Trùng tên khuyến mãi',
            'sales_code.required' => 'Bạn chưa nhập mã khuyến mãi',
            'sales_code.unique' => 'Trùng mã khuyến mãi',
            'sales_discount.required' => 'Bạn chưa nhập phần trăm khuyến mãi',
            'sales_discount.integer' => 'Phần trăm khuyến mãi phải là số',
            'sales_discount.integer' => 'Phần trăm khuyến mãi phải là số',
            'sales_discount.between' => 'Phần trăm khuyến mãi 1-99',
        ];
        $validated = $request->validate([
            'sales_name' => 'required|unique:sales,sales_name,'. $sale->id.'',
            'sales_code' => 'required|unique:sales,sales_code,'. $sale->id.'',
            'sales_discount' => 'required|integer|between:1,99',
        ], $messages);
        $sale->update([
            'sales_name' => $request->input('sales_name'),
            'sales_code' => $request->input('sales_code'),
            'sales_discount' => $request->input('sales_discount'),
        ]);
        return  redirect('/sale')->with('success','Cập nhật thành công');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = Sale::where('id', $id)->delete();
        return redirect('/sale')->with('Xóa','Thêm thành công');
    }
}
