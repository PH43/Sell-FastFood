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
    @include('components.slide')
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{ $category_product->name }}</h2>
                        @foreach($products  as $product)
                            <div class="col-sm-4" style="height: 400px">
                                <div class="product-image-wrapper" style="height: 380px">
                                    <div class="single-products" style="height: 340px">
                                        <div class="productinfo text-center">
                                            <img style="width: 180px;height: 180px" src="{{ $product->feature_image_path }}" alt="" />
                                            <h2 >{{ number_format($product->price) }} VNĐ</h2>
                                            <p style="height: 30px">{{ $product->name }}</p>
                                            <a href="{{ route('homes.product_detail', ['id' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-info"></i>Chi tiết sản phẩm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12" style="margin-left: 300px">
                            {{ $products->links() }}
                        </div>
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection






