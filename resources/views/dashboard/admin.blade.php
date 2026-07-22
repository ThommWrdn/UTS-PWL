@extends('layouts.app')

@section('content')

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="display-6 fw-bold">Dashboard Admin</h1>
            <p class="lead text-muted mb-0">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>!</p>
        </div>
        <div class="col-md-6 d-flex justify-content-md-end gap-2 mt-3 mt-md-0 flex-wrap">
            @if(Auth::user()->role == 'admin')
                <a href="/product" class="btn btn-primary shadow-sm"><i class="bi bi-box me-1"></i>Kelola Data Produk</a>
                <a href="{{ route('category.index') }}" class="btn btn-outline-primary shadow-sm"><i class="bi bi-tags me-1"></i>Kelola Kategori</a>
                <a href="{{ route('admin.orders') }}" class="btn btn-warning shadow-sm text-dark"><i class="bi bi-basket2 me-1"></i>Kelola Pesanan</a>
            @endif
        </div>
    </div>

    <!-- Metric Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3 text-success">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                    <div>
                        <h6 class="card-subtitle text-muted mb-1 fs-7">Total Pendapatan</h6>
                        <h4 class="card-title fw-bold mb-0 text-success">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3 text-warning">
                        <i class="bi bi-bag-check fs-3"></i>
                    </div>
                    <div>
                        <h6 class="card-subtitle text-muted mb-1 fs-7">Total Pesanan</h6>
                        <h4 class="card-title fw-bold mb-0 text-dark">{{ $totalOrders }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3 text-primary">
                        <i class="bi bi-box-seam fs-3"></i>
                    </div>
                    <div>
                        <h6 class="card-subtitle text-muted mb-1 fs-7">Total Produk</h6>
                        <h4 class="card-title fw-bold mb-0 text-primary">{{ $totalProducts }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3 text-info">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div>
                        <h6 class="card-subtitle text-muted mb-1 fs-7">Total Pelanggan</h6>
                        <h4 class="card-title fw-bold mb-0 text-info">{{ $totalUsers }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Chart 1: Status Transaksi Pesanan (Donut/Pie Chart) -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div id="chartOrderStatus" style="width: 100%; height: 350px;"></div>
                </div>
            </div>
        </div>

        <!-- Chart 2: Jumlah Produk per Kategori (Column Chart) -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div id="chartCategoryProducts" style="width: 100%; height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Chart 3: Pemantauan Stok Produk (Bar Chart) -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <div id="chartProductStock" style="width: 100%; height: 380px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Highcharts Library JS -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart 1: Status Transaksi (Pie/Donut)
            Highcharts.chart('chartOrderStatus', {
                chart: {
                    type: 'pie',
                    styledMode: false
                },
                title: {
                    text: 'Status Transaksi Pesanan',
                    align: 'left',
                    style: { fontSize: '16px', fontWeight: 'bold', fontFamily: 'sans-serif' }
                },
                subtitle: {
                    text: 'Persentase pesanan berdasarkan status',
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} pesanan ({point.percentage:.1f}%)</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        innerSize: '60%',
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}',
                            distance: 15
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Jumlah Pesanan',
                    colorByPoint: true,
                    data: {!! json_encode($orderStatusData) !!}
                }],
                credits: { enabled: false }
            });

            // Chart 2: Produk per Kategori (Column)
            Highcharts.chart('chartCategoryProducts', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jumlah Produk per Kategori',
                    align: 'left',
                    style: { fontSize: '16px', fontWeight: 'bold', fontFamily: 'sans-serif' }
                },
                subtitle: {
                    text: 'Distribusi variasi produk di setiap kategori',
                    align: 'left'
                },
                xAxis: {
                    categories: {!! json_encode($categoryCategories) !!},
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Produk'
                    },
                    allowDecimals: false
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} produk</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        borderRadius: 4,
                        colorByPoint: true
                    }
                },
                series: [{
                    name: 'Jumlah Produk',
                    data: {!! json_encode($categorySeriesData) !!}
                }],
                credits: { enabled: false }
            });

            // Chart 3: Pemantauan Stok Produk (Bar)
            Highcharts.chart('chartProductStock', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Pemantauan Stok Produk',
                    align: 'left',
                    style: { fontSize: '16px', fontWeight: 'bold', fontFamily: 'sans-serif' }
                },
                subtitle: {
                    text: 'Jumlah sisa stok tersedia untuk setiap produk',
                    align: 'left'
                },
                xAxis: {
                    categories: {!! json_encode($stockProductNames) !!},
                    title: { text: null }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Sisa Stok (Unit)',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    },
                    allowDecimals: false
                },
                tooltip: {
                    valueSuffix: ' unit'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        },
                        borderRadius: 4,
                        color: '#0d6efd'
                    }
                },
                series: [{
                    name: 'Sisa Stok',
                    data: {!! json_encode($stockValues) !!}
                }],
                credits: { enabled: false }
            });
        });
    </script>

@endsection
