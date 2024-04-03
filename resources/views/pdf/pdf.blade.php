<!DOCTYPE html>
<html>
<head>
    <title>PDF Document</title>
</head>
<body>
    <h1 class="text-center">Hóa đơn mua hàng</h1>
    <p>Tên người đặt hàng: {{$order->name}}</p>
    <p>Địa chỉ: {{$order->address}}</p>
    <p>Số điện thoại: {{$order->phone}}</p>
    <p>Email: {{$order->email}}</p>
    <p>Thời gian đặt hàng: {{date("H:i:s d-m-Y", strtotime($order->order_date))}}</p>
</body>
</html>
