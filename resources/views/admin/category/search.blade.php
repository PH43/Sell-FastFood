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
                    @include('admin.partials.search_category')
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
                                    <td><a href="{{ route('categories.edit', ['id' => $search->id]) }}"
                                           class="btn btn-secondary">Cập nhật</a>
                                        <a href="{{ route('categories.delete', ['id' => $search->id]) }}"
                                           class="btn btn-danger">Xóa</a></td>
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


    <script type="text/javascript">
        $('#keywords').keyup(function () {
            var query = $(this).val();
            if (query != ''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ url('/admin/categories/autocomplete_search') }}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function (data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            }else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.search_ajax_category_li', function () {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
@endsection

