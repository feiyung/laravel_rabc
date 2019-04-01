<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>登录</title>

    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" id="login">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">登录</h1>
            <img src="{{asset('images/login-logo.png')}}" alt=""/>
        </div>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="用户名" autofocus name="uname">
            <input type="password" class="form-control" placeholder="密码" name="password" id="p">

            <button class="btn btn-lg btn-login btn-block" type="button" id="submit">
                <i class="fa fa-sign-in"></i>  登录
            </button>

            {{--<div class="registration">
                Not a member yet?
                <a class="" href="registration.html">
                    Signup
                </a>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>--}}

        </div>

        <!-- Modal -->
       {{-- <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-primary" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- modal -->

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/modernizr.min.js')}}"></script>
<script src="{{asset('js/layer/layer.js')}}"></script>
<script>
    function layerMsgFail(msg) {
        layer.msg('<i class="fa fa-times-circle" style="color: #fc8675;"></i>  '+msg);
    }
    $("#submit").click(function () {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('admin.login') }}",
            async: true,
            data: $('#login').serialize(),
            success: function (result) {
                if(result.flag==1){
                    if(result.data.url){
                        window.location.href = result.data.url;
                    }else{
                        window.location.href = "{{ route('admin.home') }}"
                    }

                }else{
                    layerMsgFail(result.msg)
                }

            },
            error: function(data) {
                alert("error:"+data.responseText);
            }

        });

    })

    $('#login')[0].onkeydown = function(e){
        var ev =  window.event || e;
        if(ev.keyCode==13) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.login') }}",
                async: true,
                data: $('#login').serialize(),
                success: function (result) {
                    if(result.flag==1){
                        if(result.data.url){
                            window.location.href = result.data.url;
                        }else{
                            window.location.href = "{{ route('admin.home') }}"
                        }
                    }else{
                        layerMsgFail(result.msg)
                    }

                },
                error: function(data) {
                    alert("error:"+data.responseText);
                }

            });
        }
    }

</script>
</body>
</html>
