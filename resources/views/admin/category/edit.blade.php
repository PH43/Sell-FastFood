@extends('layouts.layoutadmin')

@section('title')
    <title>Danh mục</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang cập nhật', 'name' => 'danh mục'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        @if(session()->has('message_success'))
                            <p style="color: green">{{ session()->get('message_success') }}</p>
                        @endif
                        <form method="post" action="{{ route('categories.update', ['id' => $category->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ $category->name }}"
                                        placeholder="Nhập tên danh mục">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


