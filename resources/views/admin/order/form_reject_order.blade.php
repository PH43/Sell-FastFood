@extends('layouts.layoutadmin')

@section('title')
    <title>Đơn đặt hàng</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang hủy', 'name' => 'đơn hàng'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12" style="display: flex; margin-bottom: 15px;">
                        <div class="col-md-6" style="border: 1px solid #c9c9c9; padding: 20px ;margin-left: 260px; border-radius: 20px;">
                            <div style="text-align: center">
                                <h3>Thông tin người đặt hàng</h3>
                            </div>
                            <p style="background: #e6e6e6"> <span>Tên : {{ $order->name }}</span></p>
                            <p style="background: #e6e6e6"> <span>Email : {{ $order->email }}</span></p>
                            <p style="background: #e6e6e6"> <span>Số điện thoại : {{ $order->phone }}</span></p>
                            <p style="background: #e6e6e6"> <span>Địa chỉ : {{ $order->address }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if(session()->has('message_reject_order'))
                            <p style="color: green">{{ session()->get('message_reject_order') }}</p>
                        @endif
                        <h5>Trạng thái đơn hàng <span> : {{ $order->status }} </span></h5>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>

                                <th scope="col">Ảnh</th>
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

                                    <td><img style="width: 70px; height: 70px" src="{{ $order_detail->product->feature_image_path }}" alt=""></td>
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
                        <form action="{{ route('orders.send_mail_reject', ['id' => $order->id]) }}" method="post">
                            @csrf
                            <div class="col-md-12" style="display: flex">
                                <div style="border: 1px solid #c9c9c9;border-radius: 20px; width: 800px; margin-left: 10px;padding: 30px;margin-right: 10px;height: 350px">
                                    <h4 style="text-align: center; margin-top: -15px">Ghi chú đơn hàng</h4>
                                    <textarea class="form-control tinymce_editor_content_product" name="order_note" rows="10">
                                        <?php
                                        if (!empty($order->order_note)){
                                            echo $order->order_note;
                                        }
                                        ?>
                                    </textarea>
                                </div>
                                <div
                                    style="border: 1px solid #c9c9c9;border-radius: 20px; height: 100px; width: 400px; padding: 30px">
                                    <p style="color: red; background: blanchedalmond;">Tổng tiền : <span style="float: right"><?php echo number_format($total) ?> VND</span>
                                    </p>

                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: center; margin-top: 30px">
                                <button type="submit" class="btn btn-primary">Hủy đơn hàng</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('js/add_product.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/7i193hzfv2r8tp3eqbkffrig8kbdr8rg5pqpvcls77ns60ux/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection











