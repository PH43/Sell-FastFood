@extends('layouts.layoutadmin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang cập nhật', 'name' => 'sản phẩm'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        @if(session()->has('message_success'))
                            <p style="color: green">{{ session()->get('message_success') }}</p>
                        @endif
                        <form method="post" action="{{ route('products.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Giá</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"  name="price" value="{{ $product->price }}" placeholder="Nhập giá">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label >Chọn danh mục</label><span style="color: red"> *</span>
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
                                <label >Ảnh đại diện</label><span style="color: red"> *</span>
                                <input type="file" class="form-control-file" name="feature_image_path">
                                <div>
                                    <p style="margin-top: 10px">{{ $product->feature_image_name }}</p>
                                    <img src="{{ $product->feature_image_path }}" style="width: 120px; height: 170px; object-fit:cover" alt="">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label >Ảnh chi tiết</label><span style="color: red"> *</span>
                                <input type="file" class="form-control-file" multiple name="image_path[]">
                                <div style="display: flex">
                                @foreach($product->images as $product_multiple_images)
                                    <div style="margin: 10px">
                                        <p style="margin-top: 10px">{{ $product_multiple_images->image_name }}</p>
                                        <img src="{{ $product_multiple_images->image_path }}" style="width: 120px; height: 170px; object-fit:cover" alt="">
                                    </div>

                                @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label >Mô tả sản phẩm</label><span style="color: red"> *</span>
                                <textarea class="form-control tinymce_editor_content_product" name="contents" rows="6">{{ $product->content }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
