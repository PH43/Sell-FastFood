@extends('layouts.layoutadmin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.header', [ 'key' => 'Trang', 'name' => 'chủ'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    home
                </div>
            </div>
        </div>
    </div>

@endsection


