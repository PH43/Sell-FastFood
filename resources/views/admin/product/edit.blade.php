@extends('layouts.layoutadmin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang thêm', 'name' => 'sản phẩm'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="{{ route('products.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" placeholder="Nhập tên danh mục">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" placeholder="Nhập tên danh mục">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label >Chọn danh mục</label>
                                <select class="form-control" name="category_id">
                                    @foreach( $categories as $category)
                                        <option
                                            <?php
                                            if ( $product->category_id == $category->id){
                                                echo 'selected';
                                            }
                                            ?>
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Ảnh đại diện</label>
                                <input type="file" class="form-control-file" name="feature_image_path">
                                <img src="{{ $product->feature_image_path }}" style="width: 120px; height: 170px; object-fit:cover" alt="">
                            </div>
                            <div class="form-group">
                                <label >Ảnh chi tiết</label>
                                <input type="file" class="form-control-file" multiple name="image_path[]">
                                @foreach($product->images as $product_multiple_images)
                                    <img src="{{ $product_multiple_images->image_path }}" style="width: 120px; height: 170px; object-fit:cover" alt="">
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label >Mô tả sản phẩm</label>
                                <textarea class="form-control tinymce_editor_content_product" name="contents" rows="6">{{ $product->content }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
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