<!DOCTYPE html>
<html>

<head>
    @include('layouts._header')
    <link rel="stylesheet" href="/statics/plugin/login/login.css">
</head>

<body class="hold-transition login-page" style="background: url('/statics/plugin/login/b1.jpg'); background-size: cover;">
    <div class="login-box">
        <div class="login-logo">
                <b>Wingca</b>Admin
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">

            <form action="{{ route('register') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4" style="float: right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">注册</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block  btn-wechat btn-flat">
                    <i class="fa fa-wechat"></i> 使用微信登陆</a>
            </div>
            <!-- /.social-auth-links -->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

@include('layouts._footer')
<script>
@if(count($errors) > 0)
@foreach($errors -> all() as $error)
toastr.warning("{{ $error }}", '登陆失败');
@endforeach
@endif
</script>
</body>

</html>
