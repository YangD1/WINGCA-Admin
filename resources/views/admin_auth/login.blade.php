<!DOCTYPE html>
<html>
<head>
    @include('layouts._header')
    <link rel="stylesheet" href="/statics/plugin/login/login.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            /* background: black; */
            /* background: linear-gradient(to bottom, #dcdcdc 0%, palevioletred 100%); */
        }

        #main-canvas {
            width: 100%;
            height: 100%;
        }

        #canvas{
            position: absolute;
            top: 0;
            z-index: -1;
        }

        .filter {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: #fe5757;
            animation: colorChange 30s ease-in-out infinite;
            animation-fill-mode: both;
            mix-blend-mode: overlay;
            
        }

        @keyframes colorChange {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: .7;
            }
        }    
    </style>
</head>
<body class="hold-transition login-page" style="background: url('/statics/plugin/login/b1.jpg'); background-size: cover;">
    <div class="login-box">
        <div class="login-logo">
                <b>Wingca</b>Admin
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">

            <form action="{{ route('admin.login') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                @if(session('ls') >= 3)
                <div class="form-group code">
                    <input type="text" class="form-control" placeholder="Code" name="captcha">
                    <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='/captcha/default?'+Math.random()" alt="验证码">
                </div>
                @endif
                <div class="row">
                    <div class="col-xs-4" style="float: right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                    </div>
                </div>
            </form>

            <!-- <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block  btn-wechat btn-flat">
                    <i class="fa fa-wechat"></i> 使用微信登陆</a>
            </div> -->
            
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


@if(Session::has('danger'))
    toastr.warning("{{ Session::get('danger') }}");
@endif
</script>
</body>
   <canvas id="canvas"></canvas> 
    <script src="/statics/plugin/canvasstar.js"></script>
   <script>
       var CanvasStar = new CanvasStar;
        CanvasStar.init(); 
   </script>
</html>
