@extends('Admin.layout.sidebar')
@section('title')
    角色编辑
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
                        角色编辑
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info fade in">
                            <strong><i class="fa fa-info-circle"></i></strong> 带有红色 * 号的选项为必填
                        </div>
                        <div class="col-lg-12">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="role">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group ">
                                        <label for="" class="control-label col-sm-2">
                                            <span>*</span>
                                            角色名称
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group ">
                                              <span class="input-group-addon">
                                               <i class="fa  fa-user"></i>
                                              </span>
                                                <input type="text" class="form-control" name="role_name" value="{{ $roleInfo->role_name }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-sm-2"><span>*</span>角色排序</label>
                                        <div class="col-sm-8">
                                            <div id="spinner1">
                                                <div class="input-group input-small">
                                                    <input type="text" class="spinner-input form-control" maxlength="4" required name="sort" value="{{ $roleInfo->sort }}">
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
                                                    <input tabindex="3" type="radio" name="status" @if($roleInfo->status == 1)checked @endif id="on" value="1">
                                                    <label for="on">启用</label>
                                                </div>
                                                <div class="radio " >
                                                    <input tabindex="3" type="radio" name="status" @if($roleInfo->status == 0)checked @endif id="off" value="0">
                                                    <label for="off">禁用</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2"><span>*</span>分配权限</label>

                                        <div class="col-sm-8">
                                            <select multiple="multiple" class="multi-select" id="my_multi_select2"
                                                    name="permission[]">
                                                @foreach($trueList as $val)
                                                <optgroup label="{{ $val->id }}" name="{{ $val->permission_name }}">
                                                    @if($val->pid == 0)
                                                    <option value="{{ $val->id }}" @if(in_array($val->id,$permission_ids))selected @endif>{{ $val->permission_name }}</option>
                                                    @endif
                                                    @foreach($val->permission as $item)

                                                    <option value="{{ $item->id }}" @if(in_array($item->id,$permission_ids))selected @endif>{{ $item->permission_name }}</option>
                                                    @endforeach

                                                </optgroup>
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
    <script type="text/javascript" src="{{asset('js/fuelux/js/spinner.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-multi-select/js/jquery.quicksearch.js')}}"></script>
    <script>
        $(function(){
            $('.flat-green input').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
        $('#spinner1').spinner();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true,
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
                type: "put",
                dataType: "json",
                url: "{{ route('role.update',['role'=>$roleInfo->id]) }}",
                async: true,
                data: $('#role').serialize(),
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