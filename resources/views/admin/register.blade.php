<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('css/login_admin.css') }}">
    <link href="{{ asset('css/add_user_admin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <style rel="stylesheet">
        .select2-selection__choice__display{
            color: white !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="register_a" id="register-form-link">Đăng ký</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <form id="register-form" action="{{ route('admins.register') }}" method="post" role="form" >
                                @csrf
                                <div class="form-group">
                                    <label for="" class="label_warning">Tên</label><span style="color: red"> *</span>
                                    <input type="text"  name="name" id="username" tabindex="1" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên" value="">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_warning">Email</label><span style="color: red"> *</span>
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email" value="">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_warning">Mật khẩu</label><span style="color: red"> *</span>
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="role_id[]" value="5">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_warning">Địa chỉ</label><span style="color: red"> *</span>
                                    <input type="text" name="address" id="username" tabindex="1" class="form-control @error('address') is-invalid @enderror" placeholder="Nhập địa chỉ" value="">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_warning">Số điện thoại</label><span style="color: red"> *</span>
                                    <input type="text" name="phone" id="username" tabindex="1" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập số điện thoại" value="">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="{{ route('admins.admin_login') }}" tabindex="5" class="forgot-password">Đăng nhập</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Đăng ký">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{ asset('js/login_admin.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(function () {
        $(".select2_role").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    });
</script>
</body>
</html>
