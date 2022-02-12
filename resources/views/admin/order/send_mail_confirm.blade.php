<h3>Chào {{ $order->name }}</h3>
<div>
    <b>{{ $status }}</b>
</div>
<div>
    <p>Tên : {{ $order->name }}</p>
    <p>Email : {{$order->email}}</p>
    <p>Số điện thoại : {{$order->phone}}</p>
    <p>địa chỉ : {{$order->address}}</p>
</div>
<div>
    <b>Thông tin sản phẩm</b>
</div>
<table border="1" cellpadding="10" cellspacing="0" width="500px">
    <thead>
    <tr>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Giá</th>
        <th scope="col">Thành tiền</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total = 0;
    ?>
    @foreach($order_details as $order_detail)

        <tr>
            <td>{{ $order_detail->product->name }}</td>
            <td>{{ $order_detail->quantity }}</td>
            <td>{{ number_format($order_detail->price) }} VNĐ</td>
            <td>
                <?php
                $subtotal = $order_detail->price * $order_detail->quantity;
                $total += $subtotal;
                echo number_format($subtotal) . ' ' . 'VNĐ';
                ?>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div style="width: 500px; display: flex">
    <div style="width: 300px; margin-top: 5px">
        <p> Ghi chú : <span style="float: right">{!! $order_note !!}</span></p>
    </div>
    <div  style="width: 200px;">
        <p style="color: red; background: blanchedalmond;">Tổng tiền : <span style="float: right"><?php echo number_format($total) ?> VND</span>
        </p>
    </div>


</div>
