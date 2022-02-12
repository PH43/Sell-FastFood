@extends('layouts.layoutadmin')

@section('title')
    <title>Tài khoản</title>
@endsection

@section('css')
    <link href="{{ asset('css/add_user_admin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endsection


@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang cập nhật', 'name' => 'tài khoản'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        @if(session()->has('message_success'))
                            <p style="color: green">{{ session()->get('message_success') }}</p>
                        @endif
                        <form method="post" action="{{ route('users.update', ['id' => $user->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label>Email</label><span style="color: red"> *</span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Nhập email ">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label><span style="color: red"> *</span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" placeholder="Nhập mật khẩu">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tên</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" placeholder="Nhập tên">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($role_user_check == 3)
                                <div class="form-group">
                                    <label>Vai trò</label>
                                    <p>Customer</p>
                                    <input type="hidden" class="form-control " name="role_id[]" value="3">
                                </div>
                            @else
                                <div class="form-group">
                                    <label>Chọn vai trò</label><span style="color: red"> *</span>
                                    <select class="form-control select2_role @error('role_id') is-invalid @enderror" name="role_id[]" multiple="multiple">
                                        @foreach( $roles as $role)
                                            <option
                                                {{ $role_of_user->contains('id', $role->id) ? 'selected' : '' }}
                                                value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Địa chỉ</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" placeholder="Nhập Địa chỉ">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" placeholder="Nhập Số điện thoại">
                                @error('phone')
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

@section('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(function () {
            $(".select2_role").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        });
    </script>
@endsection
