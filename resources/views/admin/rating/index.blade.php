@extends('layouts.layoutadmin')

@section('title')
    <title>
        nhận xét và đánh giá
    </title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'nhận xét và đánh giá'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

{{--                    <div class="col-md-12  m-1">--}}
{{--                        <form action="{{ url('/admin/products/search') }}" autocomplete="off" method="get">--}}
{{--                            <div style="display: flex; ">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Nhập tên</label>--}}
{{--                                    <input type="text" class="form-control" style="width: 300px;" name="search"--}}
{{--                                           id="keywords"--}}
{{--                                           placeholder="Nhập tên sản phẩm cần tìm">--}}
{{--                                </div>--}}
{{--                                <div class="form-group" style="width: 170px; margin-left: 10px; margin-right: 10px">--}}
{{--                                    <label>Chọn danh mục</label>--}}
{{--                                    <select class="form-control" name="category_id">--}}
{{--                                        <option value="">Chọn danh mục</option>--}}
{{--                                        @foreach( $categories as $category)--}}
{{--                                            <option--}}
{{--                                                value="{{  $category->id }}">{{  $category->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group" style="padding-top: 32px">--}}
{{--                                    <input type="submit" class="btn btn-info" value="Tìm kiếm">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div id="search_ajax"></div>--}}
{{--                        </form>--}}
{{--                    </div>--}}

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th style="width: 300px" scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th style="width: 300px" scope="col">Nhận xét</th>
                                <th scope="col">Đánh giá</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($ratings as $rating)
                                <tr>
                                    <th scope="row">{{ $rating->id }}</th>
                                    <td>{{ $rating->name }}</td>
                                    <td><img src="{{ $rating->feature_image_path }}" style="width: 100px; height: 80px"
                                             alt=""></td>
                                    <td>{{ $rating->comment_value }}</td>
                                    <td>
                                        @if($rating->value == 1)
                                            <img style="width: 30px; height: 30px; margin: 10px"
                                                 src="{{ asset('img/ca_chua_thoi.png') }}" alt="">
                                        @endif
                                        @if($rating->value == 2)
                                            <img style="width: 30px; height: 30px; margin: 10px"
                                                 src="{{ asset('img/ca_chua_tuoi.png') }}" alt="">
                                        @endif
                                        @if($rating->value == 3)
                                            <img style="width: 30px; height: 30px; margin: 10px"
                                                 src="{{ asset('img/ca_chua_hao_hang.png') }}" alt="">
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
{{--                    <div class="col-md-12">--}}
{{--                        {{ $products->links() }}--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
{{--    <script src="{{ asset('js/search_product.js') }}"></script>--}}
{{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
{{--    <script src="{{ asset('js/confirm_delete_product.js') }}"></script>--}}
@endsection

