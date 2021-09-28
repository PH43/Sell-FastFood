@extends('layouts.layoutadmin')

@section('title')
    <title>Danh mục</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'danh mục'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-1">Thêm</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td><a href="{{ route('categories.edit', ['id' => $category->id]) }}"
                                           class="btn btn-secondary">Cập nhật</a>
                                    <a href="{{ route('categories.delete', ['id' => $category->id]) }}"
                                           class="btn btn-danger">Xóa</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


