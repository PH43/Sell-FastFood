@extends('layouts.layoutadmin')

@section('title')
    <title>Danh mục</title>
@endsection

@section('css')

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

                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td><a href="{{ route('categories.edit', ['id' => $category->id]) }}"
                                           class="btn btn-secondary">Cập nhật</a>
                                    <a href=""
                                       data-url="{{ route('categories.delete', ['id' => $category->id]) }}"
                                           class="btn btn-danger confirm_delete">Xóa</a></td>
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
@section('js')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm_delete_category.js') }}"></script>
    <script type="text/javascript">
      $('#keywords').keyup(function () {
            var query = $(this).val();
            if (query != ''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ url('/admin/categories/autocomplete_search') }}",
                    method:"GET",
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


