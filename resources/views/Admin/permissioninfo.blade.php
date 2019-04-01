@extends('Admin.layout.sidebar')
@section('title')
    权限提示
@stop

@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="alert alert-block alert-danger fade in">

                            <strong><i class="fa fa-exclamation-triangle"></i>  您无权限访问！</strong>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

@stop
