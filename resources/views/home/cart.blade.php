@extends('layouts.master')
@section('title')
    <title>Home Page</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/cart_error.css')}}">
@endsection
@section('js')

@endsection
@section('header')
    @include('components.header')
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <section id="cart_items">
                    <div class="container">
                        @if(session()->has('message_cart_delete'))
                            <p style="color: green">{{ session()->get('message_cart_delete') }}</p>
                        @endif
                        @if(session()->has('message_cart_update_error'))
                            <p style="color: red">{{ session()->get('message_cart_update_error') }}</p>
                        @endif
                        @if(session()->has('message_cart_update_success'))
                            <p style="color: green">{{ session()->get('message_cart_update_success') }}</p>
                        @endif

                        <div class="table-responsive cart_info">

                            <table class="table table-condensed">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Sản phẩm</td>
                                    <td class="description"></td>
                                    <td class="price">Giá</td>
                                    <td class="quantity">Số lượng</td>
                                    <td class="total">Thành tiền</td>
                                    <td>Cập nhật</td>
                                    <td>Xóa</td>
                                </tr>
                                <?php
                                $carts = Cart::content();
                                ?>
                                </thead>
                                <tbody>
                                @foreach($carts as $cart)
                                    <tr>
                                        <td class="cart_product">
                                            <a href=""><img style="width: 100px;height: 100px"
                                                            src="{{ $cart->options->image }}" alt=""></a>
                                        </td>
                                        <td class="cart_description" style="margin-left: 30px">
                                            <h4 style="margin-left: 30px"><a href="">{{ $cart->name }}</a></h4>
                                        </td>
                                        <td class="cart_price">
                                            <p style="margin-top: 20px">{{ number_format($cart->price) }} VNĐ</p>
                                        </td>
                                        <form action="{{ route('homes.update_cart_qty', ['id' => $cart->rowId]) }}"
                                              method="post" style="margin-top: 18px">
                                            @csrf
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <input class="cart_quantity_input" type="text" name="quantity"
                                                           value="{{ $cart->qty }}"
                                                           autocomplete="off" size="2">
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price" style="margin-top: 12px">
                                                    <?php
                                                    $sub_total = 0;
                                                    $sub_total = $cart->qty * $cart->price;
                                                    echo number_format($sub_total) . ' ' . 'VNĐ';
                                                    ?>
                                                </p>
                                            </td>
                                            <td style="text-align: center">
                                                <button type="submit" style="border: none; color: #0e84b5"><i
                                                        class="fa fa-wrench"></i></button>
                                            </td>
                                        </form>
                                        <td style="text-align: center">
                                            <a href="{{ route('homes.delete_cart', ['id' => $cart->rowId]) }}"><i
                                                    style="color: red" class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section> <!--/#cart_items-->
            </div>
        </div>

        <section id="do_action">
            <div class="container">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area">
                            <div style="text-align: center; margin-left: 40px">
                                <h4>Điền thông tin</h4>
                            </div>
                            <form action="{{ route('homes.checkout') }}" method="post">
                                @csrf

                                <div class="form-group" style="margin-left: 40px">
                                    <label style="width: 90px" for="">Tên </label>
                                    <input placeholder="Nhập tên" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" style="width: 79%" name="name" type="text"><span style="color: red"> *</span>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 40px">
                                    <label style="width: 90px" for="">Email </label>
                                    <input placeholder="Nhập email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}"  style="width: 79%" name="email" type="email"><span style="color: red"> *</span>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 40px">
                                    <label style="width: 90px" for="">Địa chỉ </label>
                                    <input placeholder="Nhập địa chỉ" class="@error('address') is-invalid @enderror" value="{{ old('address') }}" style="width: 79%" name="address" type="text"><span style="color: red"> *</span>
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 40px">
                                    <label style="width: 90px" for="">Số điện thoại </label>
                                    <input placeholder="Nhập số điện thoại" class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}" style="width: 79%" name="phone" type="text"><span style="color: red"> *</span>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="text-align: center">
                                    <button type="submit" class="btn btn-default update">Đặt hàng</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <h4 style="text-align: center">Tổng tiền</h4>
                            <ul>
                                <li style="color: red">Tổng tiền <span
                                        style="color: red">{{ Cart::subtotal(0) }} VNĐ</span></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </section><!--/#do_action-->
    </section>
@endsection






