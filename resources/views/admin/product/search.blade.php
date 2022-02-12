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

                    <div class="col-md-12  m-1">
                        <form action="{{ url('/admin/products/search') }}" autocomplete="off" method="get">
                            <div style="display: flex; ">
                                <div class="form-group" >
                                    <label>Nhập tên</label>
                                    <input type="text" class="form-control" style="width: 300px;" value="{{ $value_search }}" name="search" id="keywords"
                                           placeholder="Nhập tên sản phẩm cần tìm">
                                </div>
                                <div class="form-group" style="width: 170px; margin-left: 10px; margin-right: 10px">
                                    <label>Chọn danh mục</label>
                                    <select class="form-control" name="category_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach( $categories as $category)
                                            <option
                                                <?php
                                                if ($value_category_id == $category->id){
                                                    echo 'selected';
                                                }
                                                ?>
                                                value="{{  $category->id }}">{{  $category->name }}</option>
                                        @endforeach
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
                                    <td><img src="{{ $product->feature_image_path }}" style="width: 100px; height: 80px"
                                             alt=""></td>
                                    <td>{{ number_format($product->price) }} VNĐ</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        @can('product-edit')
                                            <a href="{{ route( 'products.edit', ['id' => $product->id]) }}"
                                               class="btn btn-secondary">Cập nhật
                                            </a>
                                        @endcan
                                        @can('product-delete')
                                            <a href=""
                                               data-url="{{ route('products.delete', ['id' => $product->id]) }}"
                                               class="btn btn-danger confirm_delete_product">Xóa
                                            </a>
                                        @endcan
                                    </td>
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
@section('js')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/search_product.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm_delete_product.js') }}"></script>
@endsection
