@extends('admin.layout')
@section('pageTitle', 'Bảng thống kê')
@section('breadcrumb-first', 'Bảng thống kê')
@section('breadcrumb-second', 'Bảng thống kê')
@section('cssLink')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endsection
@section('main')
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-three">
                <div class="float-left">
                    <i class="zmdi zmdi-folder-outline" style="color: gray;
                                    font-size: 3rem;"></i>
                </div>
                <div class="text-right">
                    <h5 class="text-success text-uppercase m-b-15 m-t-10">Sản phẩm</h5>
                    <h5 class="m-b-10"><span data-plugin="counterup">{{ $productQty }}</span></h5>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-three">
                <div class="float-left">
                    <i class="zmdi zmdi-file" style="color: gray;
                                    font-size: 3rem;"></i>
                </div>
                <div class="text-right">
                    <h5 class="text-pink text-uppercase m-b-15 m-t-10">Doanh thu</h5>
                    <h5 class="m-b-10"><span data-plugin="counterup">{{ number_format($totalRevenue) }}</span>đ
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-three">
                <div class="float-left">
                    <i class="zmdi zmdi-accounts-outline" style="color: gray;
                                    font-size: 3rem;"></i>
                </div>
                <div class="text-right">
                    <h5 class="text-purple text-uppercase m-b-15 m-t-10">Đơn hàng</h5>
                    <h5 class="m-b-10"><span data-plugin="counterup"> {{ $ordersPending }}  </span></h5>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-three">
                <div class="float-left">
                    <i class="zmdi zmdi-comment-outline" style="color: gray;
                                    font-size: 3rem;"></i>
                </div>
                <div class="text-right">
                    <h5 class="text-warning text-uppercase m-b-15 m-t-10">Tài khoản</h5>
                    <h5 class="m-b-10"><span data-plugin="counterup">{{ $users }}</span></h5>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-4">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-12">
                        <h4 class="header-title m-t-0">Top 5 sản phẩm bán chạy</h4>
                        <div>
                            <canvas id="chart-top-5"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-12">
                        <h4 style="width: 80%; float:left" class="header-title m-t-0">Doanh thu 12 tháng trong năm</h4>

                        <div style="width: 20%; float:left">
                            <form action="{{ route('dashboard') }}" method="GET">
                                <input autocomplete="off" type="text" class="form-control"
                                    value="{{ $year ?? now()->year }}" name="datepicker" id="datepicker"
                                    onchange="changeYear()" />
                            </form>
                        </div>
                        <div>
                            <canvas id="chart-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsScript')
    var resizefunc = [];
    <script src="//cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
    <script src="{{ asset('assets') }}/pages/jquery.dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        var top5 = <?= json_encode($top5) ?>;
        var revenue = <?= json_encode($revenue) ?>;
        const dataTop5 = {
            labels: [
                top5[0].name_vi,
                top5[1].name_vi,
                top5[2].name_vi,
                top5[3].name_vi,
                top5[4].name_vi,
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [
                    top5[0].sold,
                    top5[1].sold,
                    top5[2].sold,
                    top5[3].sold,
                    top5[4].sold,
                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(123, 129, 214)',
                    'rgb(60, 179, 113)',
                ],
                hoverOffset: 4
            }]
        };
        const configTop5 = {
            type: 'pie',
            data: dataTop5,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('chart-top-5'),
            configTop5
        );

        // ///////
        labelsRevenue = [];

        for (var i = 1; i <= 13; i++) {
            labelsRevenue.push(0);
        }
        for (var i = 1; i <= labelsRevenue.length; i++) {
            for (var j = 0; j < revenue.length; j++) {
                if (revenue[j].month == i) {
                    labelsRevenue[i] = revenue[j].revenue;
                };
            }
        }

        const labels = [
            'T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'
        ]

        const dataRevenue = {
            labels: labels,
            datasets: [{
                label: ['Doanh thu'],
                data: labelsRevenue.slice(-12),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };
        const configRevenue = {
            type: 'bar',
            data: dataRevenue,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
        const myChart2 = new Chart(
            document.getElementById('chart-revenue'),
            configRevenue,
        );

        function changeYear() {
            $.ajax({
                url: "/quan-tri/changeYearOfRevenue/" + $('#datepicker').val(),
                method: "GET"
            }).done(function(response) {
                revenue = response;
                // ///////
                labelsRevenue = [];

                for (var i = 1; i <= 13; i++) {
                    labelsRevenue.push(0);
                }
                for (var i = 1; i <= labelsRevenue.length; i++) {
                    for (var j = 0; j < revenue.length; j++) {
                        if (revenue[j].month == i) {
                            labelsRevenue[i] = revenue[j].revenue;
                        };
                    }
                }

                const dataRevenue = {
                    labels: labels,
                    datasets: [{
                        label: ['Doanh thu'],
                        data: labelsRevenue.slice(-12),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                };
                const configRevenue = {
                    type: 'bar',
                    data: dataRevenue,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };  
               myChart2.data.datasets[0].data = labelsRevenue.slice(-12);
               myChart2.update();   
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        })
    </script>
@endsection
