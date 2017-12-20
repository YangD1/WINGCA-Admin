<!DOCTYPE html>
<html>

<head>
    @include('layouts._header')
</head>

<body class="gray-bg">
    <style media="screen">
        body {
            overflow: hidden;
        }

        form {
            position: absolute;
            z-index: 1000;
        }

        .logo-name {
            margin-bottom: 20px;
            font-size: 70px !important;
            letter-spacing: 0;
            height: 300px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .full-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
        }

        .shadow-bg {
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .3);
        }

        .login-input {
            background: none;
            color: #fff;
        }

        .container {
            position: absolute;
        }
    </style>
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>

    <div class="shadow-bg">
        <div class="full-bg">

            <div class="container demo-1">
                <div id="large-header" class="large-header" style="height: 715px;">
                    <canvas id="demo-canvas" width="1440" height="715"></canvas>
                </div>
            </div>

            <div class="middle-box text-center loginscreen  animated fadeInDown">
                <div>
                    <!-- 登录表单 -->
                    <form method="POST" action="{{ route('login') }}">
                        {!! csrf_field() !!}

                        <div>
                            Email
                            <input type="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div>
                            Password
                            <input type="password" name="password" id="password">
                        </div>

                        <div>
                            <input type="checkbox" name="remember"> Remember Me
                        </div>

                        <div>
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>

            <script type="text/javascript">
                var bodyBgs = [];
                bodyBgs[0] = "/statics/plugin/login/b1.jpg";
                bodyBgs[1] = "/statics/plugin/login/b2.jpg";
                bodyBgs[2] = "/statics/plugin/login/b3.jpg";
                var randomBgIndex = Math.round(Math.random() * 2);
                //输出随机的背景图
                document.write('<style>body{background:url(' + bodyBgs[randomBgIndex] + ') no-repeat; background-size: cover}</style>');
            </script>

        </div>
    </div>
    <script src="/statics/plugin/login/TweenLite.min.js" charset="utf-8"></script>
    <script src="/statics/plugin/login/EasePack.min.js" charset="utf-8"></script>
    <script src="/statics/plugin/login/position-line.js" charset="utf-8"></script>


</html>
