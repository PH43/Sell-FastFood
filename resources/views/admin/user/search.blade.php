@extends('layouts.layoutadmin')

@section('title')
    <title>Tài khoản</title>
@endsection

@section('css')

@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'tài khoản'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('users.create') }}" class="btn btn-success float-right m-1">Thêm</a>
                    </div>
                    <div class="col-md-12  m-1">
                        <form action="{{ url('/admin/user/search') }}" autocomplete="off" method="get">
                            <div style="display: flex; ">
                                <div class="form-group" >
                                    <label>Nhập thông tin cần tìm </label>
                                    <input type="text" class="form-control" style="width: 300px;" value="{{ $value_search }}" name="search" id="keywords"
                                           placeholder="Nhập tên hoặc email">
                                </div>
                                <div class="form-group" style="width: 170px; margin-left: 10px; margin-right: 10px">
                                    <label>Chọn chưc vụ</label>
                                    <select class="form-control" name="role_id">
                                        <option value="">Chọn vai trò</option>
                                        @foreach( $roles as $role)
                                            <option
                                                <?php
                                                    if ($value_role_id == $role->id){
                                                        echo 'selected';
                                                    }
                                                ?>
                                                value="{{  $role->id }}">{{  $role->name }}</option>
                                        @endforeach
                                    </select>
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
                                <th scope="col">Email</th>
                                <th scope="col">Tên tài khoản</th>
                                <th scope="col">Chức vụ</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @foreach($user->roles as $roleName)
                                            {{ $roleName->name.',' }}
                                        @endforeach
                                    </td>
                                    <td><a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                           class="btn btn-secondary">Cập nhật</a>
                                        <a href=""
                                           data-url="{{ route('users.delete', ['id' => $user->id]) }}"
                                           class="btn btn-danger confirm_delete_user">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm_delete_user.js') }}"></script>
    <script src="{{ asset('js/search_user.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script>

    </script>
@endsection

