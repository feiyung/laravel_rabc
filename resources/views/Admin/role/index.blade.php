@extends('Admin.layout.sidebar')
@section('title')
    角色管理
@stop
@section('css')
    <link href="{{asset('css/table-responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('js/ios-switch/switchery.css')}}" />
@stop
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
               {{-- <div class="panel">
                    <div class="panel-body">
                        <form class="">

                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 form-group">
                                        <input type="text" class="form-control" placeholder="用户名">
                                    </div>
                                    <div class="col-md-3 col-sm-6 form-group">
                                        <input type="text" class="form-control" placeholder="昵称">
                                    </div>
                                    <div class="col-md-3 col-sm-6 form-group">
                                        <input type="text" class="form-control" placeholder="手机号">
                                    </div>
                                    <div class="col-md-2 col-sm-6 form-group pull-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-filter"></i> 筛选
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>--}}

                <section class="panel">
                    <header class="panel-heading">

                        <div class="row">
                            <form action="{{ route('role.index') }}">
                                <div class="col-md-2 col-sm-4 form-group">
                                    <input type="text" class="form-control" placeholder="角色名" name="role_name" value="{{ request('role_name') }}">
                                </div>

                                <div class="col-md-2 col-sm-3 form-group pull-left">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-filter"></i> 筛选
                                    </button>
                                    <a href="{{ route('role.index') }}" class="btn btn-warning">
                                        <i class="fa fa-undo"></i> 撤销
                                    </a>
                                </div>
                            </form>

                            <div class="col-md-2 col-sm-3 form-group pull-right">
                                <a href="{{ route('role.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> 新增角色</a>
                            </div>
                        </div>
                    </header>
                    <div class="panel-body">
                        <section id="no-more-tables">
                            <table class="table table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                <tr>
                                    <th>ID</th>
                                    <th>角色名称</th>
                                    <th class="numeric">状态</th>
                                    <th class="numeric">排序权重</th>
                                    <th class="numeric">添加时间</th>
                                    <th class="numeric">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $v)
                                <tr>
                                    <td class="numeric" data-title="ID">{{ $v->id }}</td>
                                    <td data-title="角色名称">{{ $v->role_name }}</td>
                                    <td data-title="状态">
                                        <div class="slide-toggle">

                                            <div>

                                                    <input type="checkbox" class="js-switch-teal " @if($v->status) checked @endif data-id="{{ $v->id }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="排序权重">{{ $v->sort }}</td>
                                    <td data-title="添加时间">{{ $v->created_at }}</td>
                                    <td data-title="操作">
                                        <a href="{{ route('role.edit',['role'=>$v->id]) }}" class="btn btn-info btn-xs" title="编辑"><i class="fa fa-pencil"></i></a>
                                        {{--<a href="{{ route('role.edit',['role'=>1]) }}" class="btn btn-success btn-xs" title="权限分配"><i class="fa fa-lock"></i></a>--}}
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div class="panel-footer">Panel footer</div>
                </section>
            </div>

        </div>
    </section>
@stop
@section('js')
    <script src="{{asset('js/layer/layer.js')}}"></script>
    <script src="{{asset('js/ios-switch/switchery.js')}}" ></script>
    <script>
        $(function () {
            layer.config({
                extend: 'mycss/style.css', //加载您的扩展样式
            });
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch-teal'));

            elems.forEach(function(html) {
                var switchery = new Switchery(html, { color: '#3cc8ad' });

            });
        })
        function confirmTips() {
            layer.confirm('<i class="fa fa-exclamation-circle" style="color: #f0ad4e;font-size: 50px"></i><br><strong>确认删除</strong>', { btn: ['<i class="fa fa-sign-in"></i> 确认','<i class="fa fa-reply"></i> 取消'], title:'提示',skin:'layer-ext-myskin',closeBtn:0,move: false}, function(index){
                //do something

                layer.msg('<i class="fa fa-check-circle" style="color: #4acacb;"></i>  删除成功');
            },function(){
                layer.msg('<i class="fa fa-times-circle" style="color: #fc8675;"></i>  已取消');
            });
        }

        $(".js-switch-teal").change(function () {
            var id = $(this).attr('data-id');
            var status;
            if($(this).is(':checked')){
                status = 1
            }else{
                status = 0
            }
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('role.update.status') }}",
                async: true,
                data: {status:status,id:id,_token:"{{ csrf_token() }}"},
                success: function (result) {
                    if(result.flag==1){
                        console.log(result.data);
                        layerMsgSuccess(result.msg)

                    }else{
                        layerMsgFail(result.msg)
                    }

                },
                error: function(data) {
                    alert("error:"+data.responseText);
                }

            });
        })
    </script>
@stop