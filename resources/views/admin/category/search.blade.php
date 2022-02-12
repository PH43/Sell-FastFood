@extends('layouts.layoutadmin')

@section('title')
    <title>Danh mục</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'Tìm kiếm'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-1">Thêm</a>
                    </div>
                    <div class="col-md-12  m-1">
                        <form action="{{ url('/admin/categories/search') }}" autocomplete="off" method="get">
                            <div style="display: flex; ">
                                <div class="form-group">
                                    <label>Nhập tên</label>
                                    <input type="text" class="form-control" style="width: 300px;" name="search"
                                           id="keywords"
                                           value="{{ $value_search }}"
                                           placeholder="Nhập tên danh mục cần tìm">
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
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($searches as $search)
                                <tr>
                                    <th scope="row">{{ $search->id }}</th>
                                    <td>{{ $search->name }}</td>
                                    <td>
                                        @can('category-edit')
                                            <a href="{{ route('categories.edit', ['id' => $search->id]) }}"
                                               class="btn btn-secondary">Cập nhật</a>
                                        @endcan
                                        @can('category-delete')
                                            <a href=""
                                               data-url="{{ route('categories.delete', ['id' => $search->id]) }}"
                                               class="btn btn-danger confirm_delete">Xóa</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $searches->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/search_category.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm_delete_category.js') }}"></script>
@endsection

