@extends('layouts.master')
@section('title')
    <title>Home Page</title>
@endsection
@section('css')

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
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ $product->feature_image_path }}" alt=""/>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">

                                    <div class="item active">
                                        @foreach($product->images as $product_multiple_images)
                                            <a href=""><img style="width: 80px; height: 80px"
                                                            src="{{ $product_multiple_images->image_path }}" alt=""></a>
                                        @endforeach
                                    </div>

                                    <div class="item">
                                        @foreach($product->images as $product_multiple_images)
                                            <a href=""><img style="width: 80px; height: 80px"
                                                            src="{{ $product_multiple_images->image_path }}" alt=""></a>
                                        @endforeach
                                    </div>
                                    <div class="item">
                                        @foreach($product->images as $product_multiple_images)
                                            <a href=""><img style="width: 80px; height: 80px"
                                                            src="{{ $product_multiple_images->image_path }}" alt=""></a>
                                        @endforeach
                                    </div>

                                </div>

                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                @if(session()->has('message_cart'))
                                    <p style="color: green">{{ session()->get('message_cart') }}</p>
                                @endif
                                @if(session()->has('message_cart_error'))
                                    <p style="color: red">{{ session()->get('message_cart_error') }}</p>
                                @endif
                                <h2>{{ $product->name }}</h2>
                                <form action="{{ route('homes.add_to_cart') }}" method="post">
                                    @csrf
                                    <span>
									<span>{{ number_format($product->price) }} VNĐ</span>
									<label>Số lượng:</label>
									<input type="text" name="quantity" autocomplete="off" value="1"/><p>Tối đa 10</p>
								</span>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button style="margin-left: -1px" type="submit" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        thêm vào giỏ hàng
                                    </button>
                                </form>
                                <p><b>Cửa hàng:</b> FASTFOOD</p>
                                <p><b>Mô tả:</b> {!! $product->content !!}</p>
                                @if(!empty($show_rating))
                                    @if($show_rating < 3 )
                                        <p><b>Đánh giá:</b> <img style="width: 50px; height: 50px"
                                                                 src="{{ asset('img/unlike.png') }}" alt=""></p>
                                        <p><b>Điểm đánh giá:</b> {{ round($show_rating, 1) }}</p>
                                        <p><b>Tổng :</b> {{ $ratings }} lượt đánh giá</p>
                                    @endif
                                    @if($show_rating >= 3 && $show_rating <= 6.5 )
                                        <p><b>Đánh giá:</b> <img style="width: 50px; height: 50px"
                                                                 src="{{ asset('img/neutral.png') }}" alt=""></p>
                                        <p><b>Điểm đánh giá:</b> {{ round($show_rating, 1) }}</p>
                                        <p><b>Tổng :</b> {{ $ratings }} lượt đánh giá</p>
                                    @endif
                                    @if($show_rating > 6.5 )
                                        <p><b>Đánh giá:</b> <img style="width: 50px; height: 50px"
                                                                 src="{{ asset('img/like.png') }}" alt="">
                                        </p>
                                        <p><b>Điểm đánh giá:</b> {{ round($show_rating, 1) }}</p>
                                        <p><b>Tổng :</b> {{ $ratings }} lượt đánh giá</p>
                                    @endif
                                @else
                                    <p><b>Đánh giá:</b> Chưa có đánh giá</p>
                                @endif
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->


                </div>
                <div class="col-sm-9 padding-right" style=" float: right">
                    <div class="product-details">
                        <div style="display: flex;">
                            <div
                                style="width: 360px; border-bottom: 1px solid black; margin-bottom: 20px;margin-left: 250px">
                                <h3 style="margin-left: 140px;">Đánh giá</h3>
                            </div>
                        </div>
                        <form action="{{ route('homes.comment') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <input type="hidden" value="Guest" name="name_comment">
                            <div style="display: flex">
                                <div class="col-md-5" style="display: flex;">
                                    <div style="margin-right: 20px">
                                        <img style="width: 100px; height: 100px;"
                                             src="{{ asset('img/unlike.png') }}" alt="">
                                        <div style="text-align: center; margin-top: 10px">
                                            <p><b>Tệ</b></p>
                                            <input type="radio" name="rating_value" value="1">
                                        </div>
                                    </div>
                                    <div style="margin-right: 20px">
                                        <img style="width: 100px; height: 100px"
                                             src="{{ asset('img/neutral.png') }}" alt="">
                                        <div style="text-align: center; margin-top: 10px">
                                            <p><b>Ổn</b></p>
                                            <input type="radio" checked name="rating_value" value="5">
                                        </div>
                                    </div>
                                    <div style="margin-right: 20px">
                                        <img style="width: 100px; height: 100px"
                                             src="{{ asset('img/like.png') }}" alt="">
                                        <div style="text-align: center; margin-top: 10px">
                                            <p><b>Ngon</b></p>
                                            <input type="radio" name="rating_value" value="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7" style="border-radius: 10px">
                                    <div>
                                        <p style="margin-top: 10px"><b>Nhận xét</b></p>
                                        <textarea placeholder="Nhận xét! có thể đánh giá mà không cần nhận xét"
                                                  style="border: 1px solid #888;border-radius: 10px"
                                                  name="comment_value" id="" cols="30" rows="3"></textarea>
                                        <input style="float: right; margin-top: 10px" class="btn btn-info" type="submit"
                                               value="Đánh giá">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-sm-9 padding-right" style=" float: right">
                    <div class="product-details">
                        <div style="display: flex;">
                            <div>
                                <h3>Nhận xét sản phẩm</h3>
                            </div>
                        </div>
                        <div>

                            <div>
                                @if(!empty($comments))
                                    @foreach($comments as $comment)
                                        <div
                                            style="width: 100%;height: 100px; border: 1px solid #888; border-radius: 10px; display: flex; margin-bottom: 10px">
                                            <div style="width: 50px; height: 100px;">
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
                                            </div>
                                            <div style="margin-top: 10px">
                                                <p><b>{{ $comment->name_comment }}</b></p>
                                                <p style="margin-top: -10px">{{ $comment->comment_value }}</p>
                                            </div>
                                        </div>

                                    @endforeach
                                    <div style="text-align: center">
                                        {{ $comments->links() }}
                                    </div>
                                @else
                                    <div>
                                        abc
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection






