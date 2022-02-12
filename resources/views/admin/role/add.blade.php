@extends('layouts.layoutadmin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'thêm quyền'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên vai trò</label><span style="color: red"> *</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" placeholder="Nhập tên quyền">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="card mb-3" style="width: 500px ; margin-right: 20px">
                                            <div class="card-header">
                                                <label for="">
                                                    <input type="checkbox" class="checkbox_parent">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>

                                            <div class="row">

                                                @foreach($permission->permission_parent as $permission_childrent)
                                                    <div class="card-body text-dark col-md-5" style="margin-left: 15px">
                                                        <h5 class="card-title">
                                                            <label for="">
                                                                <input type="checkbox" name="permission_id[]"
                                                                       class="checkbox_childrent"
                                                                       value="{{$permission_childrent->id}}">
                                                            </label>
                                                            {{$permission_childrent->name}}
                                                        </h5>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" style="margin-left: 485px" class="btn btn-primary">Thêm</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('js/checkbox_role.js') }}"></script>
@endsection
