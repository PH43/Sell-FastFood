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
@endsection
