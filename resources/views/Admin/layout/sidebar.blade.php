<!DOCTYPE html>
<html lang="en">
<head>
    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <!-- END META -->


    <!-- BEGIN SHORTCUT ICON -->
    <link rel="shortcut icon" href="{{asset('images/logo_icon.png')}}">
    <!-- END SHORTCUT ICON -->
    <title>@yield('title','后台管理')</title>

    <!-- BEGIN STYLESHEET -->
    @section('csstop')
    @show
    <link href="{{asset('css/style.css')}}" rel="stylesheet"><!-- THEME BASIC CSS  -->
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet"><!-- THEME RESPONSIVE CSS  -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
    <!-- END STYLESHEET -->

    @section('css')
    @show
</head>
<body class="sticky-header">
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="{{ route('admin.home') }}"><img src="{{asset('images/logo.png')}}" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="{{ route('admin.home') }}"><img src="{{asset('images/logo_icon.png')}}" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->


            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
               {{-- @foreach($share['menu'] as $val)
                <li class="@if($val->permission->count())menu-list @endif"><a href="{{ route('admin.home') }}">{!! $val->menu_icon !!} <span>{{ $val->permission_name }}</span></a>
                    @if($val->permission->count())
                    <ul class="sub-menu-list">
                        @foreach($val->permission()->get(['permission_name','route']) as $item)
                        <li class="@if($share['route']==$item->route) active @endif"><a href="{{ route($item->route) }}"> {{ $item->permission_name }}</a></li>
                        @endforeach

                    </ul>
                    @endif
                </li>
                @endforeach--}}
                @foreach($share['menu'] as $val)
                    <li class="@if($val->children->count())menu-list @endif @if($val->route==$share['route'])  active @elseif($share['pid'] == $val->id) nav-active @endif"><a href="{{ route('admin.home') }}">{!! $val->menu_icon !!} <span>{{ $val->permission_name }}</span></a>
                        @if($val->children->count())
                            <ul class="sub-menu-list">
                                @foreach($val->children as $item)
                                    <li class="@if($share['route']==$item->route || $share['pid'] ==$item->id) active @endif"><a href="{{ route($item->route) }}"> {{ $item->permission_name }}</a></li>
                                @endforeach

                            </ul>
                        @endif
                    </li>
                @endforeach
                {{--<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>系统管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="{{ route('adminer.index') }}"> 管理员</a></li>
                        <li><a href="{{ route('permission.index') }}"> 权限管理</a></li>
                        <li><a href="{{ route('role.index') }}"> 角色管理</a></li>

                    </ul>
                </li>--}}


            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->


            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">

                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('images/photos/user-avatar.png')}}" alt="" />
                            {{ session('admin_user') ?session('admin_user')->nickname:'' }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>  个人中心</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  设置</a></li>
                            <li><a href="{{ route('admin.loginout') }}"><i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->

    @section('content')
    @show



    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('js/jquery-ui-1.9.2.custom.min.js')}}"></script>
<script src="{{asset('js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/modernizr.min.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.js')}}"></script>
<!--common scripts for all pages-->
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/layer/layer.js')}}"></script>
<script>
    $(document).ready(function(){
        if($(".sub-menu-list li").hasClass("active")){
            $(".sub-menu-list li.active").parent().parent('li').addClass('nav-active')
        }
    })
    $('.menu-list a').click(function(){
        $('.left-side').getNiceScroll().resize();
    })
    function layerMsgSuccess(msg) {
        layer.msg('<i class="fa fa-check-circle" style="color: #4acacb;"></i>  '+msg);
    }
    function layerMsgFail(msg) {
        layer.msg('<i class="fa fa-times-circle" style="color: #fc8675;"></i>  '+msg);
    }
    function layerMsgSuccessReload(msg) {
        layer.msg('<i class="fa fa-check-circle" style="color: #4acacb;"></i>  '+msg,{
            time:2000
        },function () {
            window.location.reload();
        });
    }
</script>
@section('js')

@show
</body>
</html>