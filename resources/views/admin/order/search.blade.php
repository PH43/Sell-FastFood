@extends('layouts.layoutadmin')

@section('title')
    <title>Đơn đặt hàng</title>
@endsection

@section('css')

@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang tìm kiếm', 'name' => 'Đơn đặt hàng'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12  m-1">
                        <form action="{{ url('/admin/orders/search') }}" autocomplete="off" method="get">

                            <div style="display: flex; ">
                                <div class="form-group" >
                                    <label>Nhập thông tin cần tìm </label>
                                    <input type="text" class="form-control" value="{{ $search_value }}" style="width: 300px;" name="search" id="keywords"
                                           placeholder="Nhập tên hoặc email">
                                </div>
                                <div class="form-group" style="width: 170px; margin-left: 10px; margin-right: 10px">
                                    <label>Chọn trạng thái</label>
                                    <select class="form-control" name="status">
                                        <option  value="">Chọn trạng thái</option>
                                        <option <?php
                                                if ($status == 'Chờ duyệt')
                                                    echo 'selected'
                                                ?> value="Chờ duyệt">Chờ duyệt</option>
                                        <option <?php
                                                if ($status == 'Đơn hàng đã giao')
                                                    echo 'selected'
                                                ?> value="Đơn hàng đã giao">Đơn hàng đã giao</option>
                                        <option <?php
                                                if ($status == 'Đơn hàng đã duyệt')
                                                    echo 'selected'
                                                ?> value="Đơn hàng đã duyệt">Đơn hàng đã duyệt</option>
                                        <option <?php
                                                if ($status == 'Đơn hàng đã hủy')
                                                    echo 'selected'
                                                ?> value="Đơn hàng đã hủy">Đơn hàng đã hủy</option>
                                    </select>
                                </div>
                                <div class="form-group" style="padding-top: 32px">
                                    <input type="submit" class="btn btn-info" value="Tìm kiếm">
                                </div>
                            </div>
                            <div id="search_ajax"></div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $order->status }}
                                    </td>
                                    <td>
                                        @can('order-confirm')
                                            <a href="{{ route('orders.change_status', ['id' => $order->id]) }}"
                                               class="btn btn-success">Duyệt
                                            </a>
                                        @endcan
                                        @can('order-reject')
                                            <a href="{{ route('orders.show_form_reject', ['id' => $order->id]) }}"
                                               class="btn btn-secondary">Hủy
                                            </a>
                                        @endcan
                                            <a href=""
                                               data-url="{{ route('orders.ship', ['id' => $order->id]) }}"
                                               class="btn btn-info ship_order">Đã giao
                                            </a>
                                        @can('order-delete')
                                            <a href=""
                                               data-url="{{ route('orders.delete', ['id' => $order->id]) }}"
                                               class="btn btn-danger confirm_delete_order">Xóa
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm_delete_order.js') }}"></script>
    <script src="{{ asset('js/search_order.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/ship_order.js') }}"></script>
@endsection
