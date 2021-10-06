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
                            <a href="#" class="active" id="login-form-link">Đăng nhập</a>
                        </div>

                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session()->has('message'))
                                <p style="color: red">{{ session()->get('message') }}</p>
                            @endif
                            <form id="login-form" action="{{ route('admins.post_login') }}" method="post" role="form" style="display: block;">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="label_warning">Email</label><span style="color: red"> *</span>
                                    <input type="email" name="email" id="username" tabindex="1" class="form-control" placeholder="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_warning">Mật khẩu</label><span style="color: red"> *</span>
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" value="{{ old('password') }}" placeholder="Mật khẩu">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="{{ route('admins.show_form_register') }}" tabindex="5" class="forgot-password">Đăng ký</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Đăng nhập">
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
