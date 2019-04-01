@extends('Admin.layout.sidebar')
@section('title')
    首页
@stop
@section('css')
    <style>
        ul.bar-legend {
            margin-top: 20px !important;
        }
    </style>
@stop
@section('content')
    <div class="page-heading">
        <h3>
            统计仪表盘
        </h3>

    </div>
    <section class="wrapper">
        <div class="row">
            <div class="col-md-6">
                <!--statistics start-->
                <div class="row state-overview">
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <div class="panel purple">
                            <div class="symbol">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="state-value">
                                <div class="value"> 3696</div>
                                <div class="title">注册用户</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <div class="panel red">
                            <div class="symbol">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="state-value">
                                <div class="value">1026</div>
                                <div class="title">普惠VIP</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row state-overview">
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <div class="panel blue">
                            <div class="symbol">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="state-value">
                                <div class="value">653258.75</div>
                                <div class="title"> 充值金额</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <div class="panel green">
                            <div class="symbol">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="state-value">
                                <div class="value">2110</div>
                                <div class="title"> 油气卡数量</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--statistics end-->
            </div>
            <div class="col-md-6">
                <!--more statistics box start-->
                <div class="panel deep-purple-box">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <div id="graph-donut" class="revenue-graph"></div>

                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <h3>本月充值情况</h3>
                                <ul class="bar-legend">
                                    <li><span class="blue"></span> 支付宝充值</li>
                                    <li><span class="green"></span> 微信充值</li>
                                    {{--<li><span class="purple"></span> 其他</li>--}}
                                    <li><span class="red"></span> 其他</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--more statistics box end-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">折线图</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="clearfix">
                                    <div id="main-chart-legend" class="pull-right">
                                    </div>
                                </div>
                                <div id="main-chart">
                                    <div id="main-chart-container" class="main-chart" style="padding: 0px; position: relative;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@stop

@section('js')
    <!--Morris Chart-->
    <script src="{{asset('js/morris-chart/morris.js')}}"></script>
    <script src="{{asset('js/morris-chart/raphael-min.js')}}"></script>

    <!-- jQuery Flot Chart-->
    <script src="{{asset('js/flot-chart/jquery.flot.js')}}"></script>
    <script src="{{asset('js/flot-chart/jquery.flot.tooltip.js')}}"></script>
    <script src="{{asset('js/flot-chart/jquery.flot.resize.js')}}"></script>
    <!--Dashboard Charts-->
    <script>
        $(function(){
            Morris.Donut({
                element: 'graph-donut',
                data: [
                    {value: 66, label: '支付宝', formatted: '888' },
                    {value: 34, label: '微信', formatted: '150' },
                    /*{value: 0, label: '其他', formatted: '0' },*/
                     {value: 0, label: '其他', formatted: '0' }
                ],
                backgroundColor: false,
                labelColor: '#fff',
                colors: [
                    '#5ab6df','#4bcacc','#fb8575','#fe8676','#5ab6df'
                ],
                formatter: function (x, data) { return data.formatted; }
            });

            var d1 = [
                [0, 501],
                [1, 620],
                [2, 437],
                [3, 361],
                [4, 549],
                [5, 618],
                [6, 570],
                [7, 758],
                [8, 658],
                [9, 538],
                [10, 488]

            ];
            var d2 = [
                [0, 40100],
                [1, 52000],
                [2, 337],
                [3, 261],
                [4, 449],
                [5, 518],
                [6, 470],
                [7, 658],
                [8, 558],
                [9, 438],
                [10, 388]
            ];

            var data = ([{
                label: "注册人数",
                data: d1,
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: ["rgba(255,255,255,.4)", "rgba(183,236,240,.4)"]
                    }
                }
            }/*,
                {
                    label: "充值金额",
                    data: d2,
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: ["rgba(255,255,255,.0)", "rgba(253,96,91,.7)"]
                        }
                    }
                }*/
            ]);

            var options = {
                grid: {
                    backgroundColor:
                    {
                        colors: ["#ffffff", "#f4f4f6"]
                    },
                    hoverable: true,
                    clickable: true,
                    tickColor: "#eeeeee",
                    borderWidth: 1,
                    borderColor: "#eeeeee"
                },
                // Tooltip
                tooltip: true,
                tooltipOpts: {
                    content: "%s X: %x Y: %y",
                    shifts: {
                        x: -60,
                        y: 25
                    },
                    defaultTheme: false
                },
                legend: {
                    labelBoxBorderColor: "#000000",
                    container: $("#main-chart-legend"), //remove to show in the chart
                    noColumns: 0
                },
                series: {
                    stack: true,
                    shadowSize: 0,
                    highlightColor: 'rgba(000,000,000,.2)'
                },
//        lines: {
//            show: true,
//            fill: true
//
//        },
                points: {
                    show: true,
                    radius: 3,
                    symbol: "circle"
                },
                colors: ["#5abcdf", "#ff8673"]
            };
            var plot = $.plot($("#main-chart #main-chart-container"), data, options);
        })
    </script>
@stop


