@extends('layouts.layoutadmin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'phân quyền'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('role-add')
                        <div class="col-md-12">
                            <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-1">Thêm</a>
                        </div>
                    @endcan
                    <div class="col-md-12">
                        @if(session()->has('message_success'))
                            <p style="color: green">{{ session()->get('message_success') }}</p>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh quyền</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('role-edit')
                                            <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                               class="btn btn-secondary">Cập nhật quyền
                                            </a>
                                        @endcan
                                        @can('role-delete')
                                            <a href=""
                                               data-url="{{ route('roles.delete', ['id' => $role->id]) }}"
                                               class="btn btn-danger confirm_delete_role">Xóa
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirm_delete_role.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
@endsection

