@section('dashboard', 'active')
@extends('layouts.backend.app',[
    'pageTitle' => 'Dashboard'
])
@section('content')
<p class="mb-4">Chart.js is a third party plugin that is used to generate the charts in this theme.
    The charts below have been customized - for further customization options, please visit the <a
        target="_blank" href="https://www.chartjs.org/docs/latest/">official Chart.js
        documentation</a>.</p>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-8 col-lg-7">

        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                Styling for the area chart can be found in the
                <code>/js/demo/chart-area-demo.js</code> file.
            </div>
        </div>

        
    </div>

    <!-- Donut Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                </div>
                <hr>
                <hr>
                Styling for the donut chart can be found in the
                <code>/js/demo/chart-pie-demo.js</code> file.
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <!-- Page level plugins -->
    <script src="{{ asset('template/backend/sb-admin-2') }}/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/chart-pie-demo.js"></script>
@endpush