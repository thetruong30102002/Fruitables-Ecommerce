<?php

namespace App\Http\Controllers\frontend;

use App\Cart;
use App\Helper\Cart as HelperCart;
use App\Http\Controllers\Controller;
use App\Mail\OrderSuccess;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;

class CartController extends Controller
{
    public function index(HelperCart $cart)
    {
        // dd($cart->list());
        // $carts = $cart->list();
        $page = 'Cart';
        return view('frontend.pages.cart', compact('page', 'cart'));
    }
    public function add(Request $request, HelperCart $cart)
    {
        $product = Product::find($request->id);
        $messages = [
            'quantity.required' => 'Số lượng không được để trống',
        ];
        $validated = $request->validate([
            'quantity' => 'required',
        ], $messages);
        if($request->quantity > $product->stock_quantity){
            return redirect('productdetail/'. $product->id.'')->with('error', 'Không đủ hàng');
        }else if($request->quantity == 0 ){
            return redirect('productdetail/'. $product->id.'')->with('error', 'Số lượng lớn hơn 0');
        }
        $quantity = $request->quantity;
        $cart->add($product, $quantity);
        return redirect('/')->with('success', 'Thêm thành công sản phẩm vào giỏ hàng');
    }
    public function delete(Request $request, HelperCart $cart)
    {
        // dd(session('cart'));
        // Xóa thuộc tính cụ thể trong attributes

        $arr = $request->session('cart')->get('cart');
        unset($arr[$request->id]);
        $request->session('cart')->flush();
        session(['cart' => $arr]);
        return redirect('/cart')->with('success', 'Xoá thành công');
    }
    public function discount(Request $request, HelperCart $cart)
    {
        $page = 'ChackOut';
        $sales_code = $request->sales_code;

        $sales = Sale::All();
        foreach ($sales as $sale) {
            if ($sale->sales_code == $sales_code) {
                $sales_discount = $sale->sales_discount;
                return view('frontend.pages.chackout', compact('page', 'sales_discount', 'cart'))->with('success', 'Thêm mã giảm giá thành công');
            }
        }
        return redirect('/chackout')->with('error', 'Thêm mã giảm giá thất bại');
    }
    public function chackout(HelperCart $cart)
    {
        // dd($cart->list());
        // $cart = $cart->list();
        // dd(123);
        $page = 'ChackOut';
        return view('frontend.pages.chackout', compact('page', 'cart'));
    }
    public function order(Request $request, HelperCart $cart)
    {
        $messages = [
            'email.email' => 'Email không hợp lệ VD: abc@gmail.com',
            'email.string' => 'Email phải là dạng ký tự',
            'email.required' => 'Email không được trống',
            'phone.required' => 'Phone không được trống',
            'phone.numeric' => 'Phone phải là số',
            'address.required' => 'Address không được trống',
            'name.required' => 'Name không được trống',
            'total_amount.required' => 'Total không được trống',
            'total_amount.numeric' => 'Total phải là số',
        ];

        // dd($request->all());
        $validated = $request->validate([
            'total_amount' => 'required|numeric',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|string',
        ], $messages);
        $order = Order::create([
            'total_amount' => $request->input('total_amount'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'note' => $request->input('note'),
            'email' => $request->input('email'),
            'order_date' => now(),
        ]);
        foreach ($cart->list() as $key => $item) {
            $order_detail = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);
            $product = Product::find($order_detail->product_id);
            
            $newQuantity = $product->stock_quantity - $order_detail->quantity;
            $product->update([
                'stock_quantity' => $newQuantity,
            ]);
        }
        $token = Hash::make($order->email);
        Mail::to($order->email)->send(new OrderSuccess($token));
        $request->session('cart')->flush();
        return redirect('/')->with('success', 'Đặt hàng thành công vui lòng check Mail');
    }
}
