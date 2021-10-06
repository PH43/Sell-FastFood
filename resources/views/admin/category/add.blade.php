@extends('layouts.layoutadmin')

@section('title')
    <title>Danh mục</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang thêm', 'name' => 'danh mục'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nhập tên danh mục">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


