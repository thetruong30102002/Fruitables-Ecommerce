<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Banner";
        $banners = Banner::paginate(15);
        return view('backend.banners.index', compact('title', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới Banner";
        return view('backend.banners.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'banner_name.required' => 'Bạn chưa nhập tên banner',
            'banner_name.unique' => 'Bạn nhập trùng tên banner',
            'image.required' => 'Bạn chưa thêm ảnh sản phẩm',
        ];
        $validated = $request->validate([
            'banner_name' => 'required|unique:banners',
            'image' => 'required',
        ], $messages);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('/public/banners', $fileName);

        }

        Banner::create([
            'banner_name' => $request->input('banner_name'),
            'image' => $fileName,
        ]);
        return  redirect('/banner')->with('success','Thêm thành công');;
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
        $title = "Cập nhật Banner";
        $banner = Banner::find($id);
        return view('backend.banners.edit', compact('title', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);
        $messages = [
            'banner_name.required' => 'Bạn chưa nhập tên sản phẩm',
            'banner_name.unique' => 'Bạn nhập trùng tên sản phẩm',
        ];
        $validated = $request->validate([
            'banner_name' => 'required|unique:banners,banner_name,'. $banner->id.'',
        ], $messages);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('/public/products', $fileName);
            // dd($fileName);
            // //luu
            if($banner->image){
                Storage::delete('./public/banners'.$banner->image);
            }

        }else{
            
            $fileName = $banner->image;
        }

        $banner->update([
            'banner_name' => $request->input('banner_name'),
            'image' => $fileName,
        ]);
        return  redirect('/banner')->with('success','Cập nhật thành công');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::where('id', $id)->delete();
        return redirect('/banner')->with('success','Xóa thành công');;
    }
}
