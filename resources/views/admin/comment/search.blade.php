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

                    <div class="col-md-12  m-1">
                        <form action="{{ url('/admin/comments/search') }}" autocomplete="off" method="get">
                            <div style="display: flex; ">
                                <div class="form-group">
                                    <label>Nhập tên</label>
                                    <input type="text" class="form-control" style="width: 300px;" name="search"
                                           id="keywords"
                                           placeholder="Nhập tên sản phẩm cần tìm" value="{{ $product_name }}">
                                </div>
                                <div class="form-group" style="width: 170px; margin-left: 10px; margin-right: 10px">
                                    <label>Chọn đánh giá</label>

                                    <select class="form-control" name="rating_value">
                                        <option value="">Chọn đánh giá</option>
                                        <option
                                            <?php
                                            if ($rating_value == 1)
                                                echo 'selected'
                                            ?> value="1">
                                            Tệ
                                        </option>
                                        <option
                                            <?php
                                            if ($rating_value == 5)
                                                echo 'selected'
                                            ?> value="5">Ổn
                                        </option>
                                        <option
                                            <?php
                                            if ($rating_value == 10)
                                                echo 'selected'
                                            ?> value="10">Ngon
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group" style="padding-top: 32px">
                                    <input type="submit" class="btn btn-info" value="Tìm kiếm">
                                </div>
                                <div class="form-group" style="padding-top: 32px;margin-left: 20px">
                                    <p>Tệ : <img style="height: 30px;height: 30px" src="{{ asset('img/unlike.png') }}" alt=""></p>
                                </div>
                                <div class="form-group" style="padding-top: 32px;margin-left: 20px">
                                    <p>Ổn : <img style="height: 30px;height: 30px" src="{{ asset('img/neutral.png') }}" alt=""></p>
                                </div>
                                <div class="form-group" style="padding-top: 32px;margin-left: 20px">
                                    <p>Ngon : <img style="height: 30px;height: 30px" src="{{ asset('img/like.png') }}" alt=""></p>
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
                                <th style="width: 300px" scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th style="width: 300px" scope="col">Nhận xét</th>
                                <th scope="col">Đánh giá</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($comments as $comment)
                                <tr>
                                    <th scope="row">{{ $comment->id }}</th>
                                    <td>{{ $comment->products->name }}</td>
                                    <td><img src="{{ $comment->products->feature_image_path }}"
                                             style="width: 100px; height: 80px"
                                             alt=""></td>
                                    <td>{{ $comment->comment_value }}</td>
                                    <td>
                                        @if($comment->ratting->value == 1)
                                            <img style="width: 30px; height: 30px; margin: 10px"
                                                 src="{{ asset('img/unlike.png') }}" alt="">
                                        @endif
                                        @if($comment->ratting->value == 5)
                                            <img style="width: 30px; height: 30px; margin: 10px"
                                                 src="{{ asset('img/neutral.png') }}" alt="">
                                        @endif
                                        @if($comment->ratting->value == 10)
                                            <img style="width: 30px; height: 30px; margin: 10px"
                                                 src="{{ asset('img/like.png') }}" alt="">
                                        @endif
                                    </td>
                                    @can('comment-delete')
                                    <td>
                                        <a href=""
                                           data-url="{{ route('comments.delete', ['id' => $comment->id]) }}"
                                           class="btn btn-danger confirm_delete_comment">Xóa</a>

                                    </td>
                                    @endcan
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    {{--    <script src="{{ asset('js/search_product.js') }}"></script>--}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm_delete_comment.js') }}"></script>
@endsection


