@extends('Admin.layout.sidebar')
@section('title')
    新增管理员
@stop
@section('css')

    <link href="{{asset('js/iCheck/skins/flat/green.css')}}" rel="stylesheet">
@stop
@section('csstop')
    <!--multi-select-->
    <link rel="stylesheet" type="text/css" href="{{asset('js/jquery-multi-select/css/multi-select.css')}}" />
@stop
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel ">
                    <div class="panel-heading">
                        新增权限
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info fade in">
                            <strong><i class="fa fa-info-circle"></i></strong> 带有红色 * 号的选项为必填
                        </div>
                        <div class="col-lg-12">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="permission">
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2">
                                            <span>*</span>
                                            权限名称
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-lock"></i>
                                              </span>
                                                <input type="text" class="form-control" required name="permission_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>权限路由</label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-internet-explorer"></i>
                                              </span>
                                                <input type="text" class="form-control" name="route" required>
                                            </div>
                                            <span class="help-block"><i class="fa fa-info-circle"></i>  没有填写‘#’</span>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2">权限说明</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control "  type="text" name="remark" required id="remark"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>权限等级</label>

                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-bars"></i>
                                              </span>
                                                <select name="level" id="" class="form-control" required>
                                                    <option value="1" selected>一级</option>
                                                    <option value="2" >二级</option>
                                                    <option value="3" >三级</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>权限归属</label>

                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-lock"></i>
                                              </span>
                                                <select name="pid" id="" class="form-control" required>
                                                    <option value="0" selected>顶级</option>
                                                    @foreach($list as $v)
                                                        <option value="{{ $v->id }}" >{{ $v->permission_name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2"><span>*</span>权限排序</label>
                                        <div class="col-sm-8">
                                            <div id="spinner1">
                                                <div class="input-group input-small">
                                                    <input type="text" class="spinner-input form-control" maxlength="4" required name="sort" >
                                                    <div class="spinner-buttons input-group-btn btn-group-vertical">
                                                        <button type="button" class="btn spinner-up btn-xs btn-success">
                                                            <i class="fa fa-angle-up"></i>
                                                        </button>
                                                        <button type="button" class="btn spinner-down btn-xs btn-success">
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>启用状态</label>
                                        <div class="col-sm-8 icheck">
                                            <div class="flat-green single-row">
                                                <div class="radio " style="padding-left: 0">
                                                    <input tabindex="3" type="radio" name="status" checked id="on" value="1">
                                                    <label for="on">启用</label>
                                                </div>
                                                <div class="radio " >
                                                    <input tabindex="3" type="radio" name="status" id="off" value="0">
                                                    <label for="off">禁用</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    {{--<div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>用户身份</label>
                                        <div class="col-sm-8">
                                            @for($i=0;$i<10;$i++)
                                                <div class="col-sm-6 col-lg-3 col-md-4 icheck">
                                                    <div class="flat-green  single-row">
                                                        <div class="radio ">
                                                            <input type="checkbox">
                                                            <label>超级管理员</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endfor


                                        </div>
                                    </div>--}}
                                    <div class="form-group menu">
                                        <label for="" class="control-label col-sm-2"><span>*</span>是否菜单</label>
                                        <div class="col-sm-8 icheck">
                                            <div class="flat-green single-row">
                                                <div class="radio " style="padding-left: 0">
                                                    <input tabindex="3" type="radio" name="is_menu" id="yes"value="1" required>
                                                    <label for="yes">是</label>
                                                </div>
                                                <div class="radio "  >
                                                    <input tabindex="3" type="radio" name="is_menu" id="no" checked  value="0" required>
                                                    <label for="no">否</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    {{--<div class="form-group menu-element">
                                        <label for="" class="control-label col-sm-2"><span>*</span>菜单路由</label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-internet-explorer"></i>
                                              </span>
                                                <input type="text" class="form-control" name="menu_url" required>
                                            </div>
                                        </div>
                                    </div>--}}

                                    <div class="form-group menu-element hide">
                                        <label for="" class="control-label col-sm-2">菜单图标</label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-bars"></i>
                                              </span>
                                                <input type="text" class="form-control" name="menu_icon" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-8">
                                            <button class="btn btn-success pull-right" type="button" id="submit"><i class="fa fa-save"></i>&nbsp;保存</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@stop
@section('js')
    <script src="{{asset('js/iCheck/jquery.icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/fuelux/js/spinner.min.js')}}"></script>
    <script>
        $(function(){
            $('.flat-green input').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
            $(".menu .iCheck-helper,.menu label").bind('click',function () {
                if($("input[name='is_menu']:checked").val()==1 && $("select[name='level']").val()==1){
                    $(".menu-element").removeClass('hide').addClass('show')
                }else{
                    $(".menu-element").removeClass('show').addClass('hide')
                }
            })
        });
        $('#spinner1').spinner();

        $("#submit").click(function () {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('permission.store') }}",
                async: true,
                data: $('#permission').serialize(),
                success: function (result) {
                    if(result.flag){
                        layerMsgSuccessReload(result.msg);
                    }else{
                        layerMsgFail(result.msg);
                    }

                },
                error: function(data) {
                    alert("error:"+data.responseText);
                }

            });
        })
    </script>
@stop