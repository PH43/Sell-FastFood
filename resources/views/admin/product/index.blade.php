@extends('layouts.layoutadmin')

@section('title')
    <title>
        sản phẩm
    </title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'sản phẩm'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('products.create') }}" class="btn btn-success float-right m-1">Thêm</a>
                    </div>



                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th scope="col">giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ $product->feature_image_path }}" style="width: 100px; height: 80px" alt=""></td>
                                    <td>{{ number_format($product->price) }} VNĐ</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td><a href="{{ route( 'products.edit', ['id' => $product->id]) }}"
                                           class="btn btn-secondary">Cập nhật</a>
                                        <a href="{{ route('products.delete', ['id' => $product->id]) }}"
                                           class="btn btn-danger">Xóa</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
