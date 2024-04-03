<?php

namespace App\Helper;

class Cart
{
    private $items = [];
    private $total_quantity = 0;
    private $total_price = 0;


    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
    }
    //phuong  thuc lay ve danh sach san pham
    public function list()
    {
        // dd($this->items);
        return $this->items;
    }
    //addCart
    public function add($product, $quantity = 1)
    {
        $item = [
            'productId' => $product->id,
            'name' => $product->product_name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => $quantity,
        ];

        $slnew = 0;
        if ($this->items == []) {
            $this->items[$product->id] = $item;
        } else {
            foreach ($this->items as $key => $i) {
                if ($key == $product->id) {
                    $slnew = $i['quantity'] + $quantity;
                    $i['quantity'] = $slnew;
                    $this->items[$product->id] = $i;
                    break;
                } else {
                    $this->items[$product->id] = $item;
                }
            }
        }
        session(['cart'=>$this->items]);
    }
    //updateCart

    //deletedCart 1item

    //deletedCart Allitem

    // totalPrice
    // public function getTotalPrice(){
    //     $totalPrice = 0;
    //     foreach($this->items as $item){
    //         $totalPrice += $item['price']*$item['quantity'];
    //     }
    //     return $totalPrice;
    // }
}
