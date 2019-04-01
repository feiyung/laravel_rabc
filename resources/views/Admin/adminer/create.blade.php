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
                        新增管理员
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info fade in">
                            <strong><i class="fa fa-info-circle"></i></strong> 带有红色 * 号的选项为必填
                        </div>
                        <div class="col-lg-12">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="adminer">

                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2">
                                            <span>*</span>
                                            用户名
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-user"></i>
                                              </span>
                                                <input type="text" class="form-control" required name="uname">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>昵称</label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-pencil"></i>
                                              </span>
                                                <input type="text" class="form-control" required name="nickname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>登录密码</label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-key"></i>
                                              </span>
                                                <input type="password" class="form-control" required name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>确认密码</label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-key "></i>
                                              </span>
                                                <input type="password" class="form-control" required name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>手机号码</label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-mobile fa-lg"></i>
                                              </span>
                                                <input type="text" class="form-control" required maxlength="11" name="mobile" placeholder="">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2"><span>*</span>状态</label>
                                        <div class="col-sm-8 icheck">
                                            <div class="flat-green single-row">
                                                <div class="radio " style="padding-left: 0">
                                                    <input tabindex="3" type="radio" name="status" checked id="yes" value="1">
                                                    <label for="yes">启用</label>
                                                </div>
                                                <div class="radio " >
                                                    <input tabindex="3" type="radio" name="status" id="no" value="0">
                                                    <label for="no">禁用</label>
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
                                    <div class="form-group">
                                        <label class="control-label col-sm-2"><span>*</span>用户身份</label>

                                        <div class="col-sm-8">
                                            <select name="role[]" class="multi-select" multiple="" id="my_multi_select3">
                                                @foreach($list as $v)
                                                    <option value="{{ $v->id }}">{{ $v->role_name }}</option>
                                                @endforeach

                                            </select>
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


    <script type="text/javascript" src="{{asset('js/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-multi-select/js/jquery.quicksearch.js')}}"></script>
    <script>
        $(function(){
            $('.flat-green input').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查找'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查找'>",
            afterInit: function (ms) {
                var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function (e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function (e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });
        
        $("#submit").click(function () {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('adminer.store') }}",
                async: true,
                data: $('#adminer').serialize(),
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