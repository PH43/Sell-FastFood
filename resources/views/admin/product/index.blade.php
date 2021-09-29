@extends('layouts.layoutadmin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'sản phẩm'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    trang quản lý sản phẩm
                </div>
            </div>
        </div>
    </div>

@endsection
