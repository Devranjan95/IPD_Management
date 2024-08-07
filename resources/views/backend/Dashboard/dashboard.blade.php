@extends('masterlayout.masterlayout')

@section('content')
<div class="container-fluid pt-3">
    <div class="row">
        <!-- Left Column with Cards -->
        <div class="col-md-4" style="height: 500px; overflow-y: auto;">
            <div class="row">
                <!-- Total Patients Card -->
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Patients</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPatients }}</div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{asset('assets/previous/dashboard.png')}}" alt="Total Patients" style="width: 3rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total InBed Patients Card -->
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total In-Bed Patients</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalInBedPatients }}</div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{asset('assets/previous/dashboard.png')}}" alt="InBed Patients" style="width: 3rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Deceased Card -->
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Deceased</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDeceased }}</div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{asset('assets/previous/dashboard.png')}}" alt="Deceased" style="width: 3rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Born Card -->
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Born</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBorn }}</div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{asset('assets/previous/dashboard.png')}}" alt="Total Born" style="width: 3rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Discharged Card -->
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Discharged</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDischarged }}</div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{asset('assets/previous/dashboard.png')}}" alt="Discharged" style="width: 3rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column with Graph -->
        <div class="col-md-7 offset-md-1" style="height: 520px; overflow-y: auto;">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Patient Distribution</h6>
                </div>
                <div class="card-body" style="width:100%;height:500px">
                    <canvas id="patientPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ********************************** -->


@endsection
@section('scripts')
<style>

    .card {
        background: linear-gradient(145deg, #ffffff, #f1f5f9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2), 0 12px 32px rgba(0, 0, 0, 0.1);
    }

    .card .card-body {
        padding: 1.5rem;
    }
    
    .card .card-body .text-xs {
        font-size: 0.875rem;
        font-weight: bold;
        text-transform: uppercase;
    }
    
    .card .card-body .h5 {
        font-size: 1.25rem;
        font-weight: 700;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    // Data for the pie chart
    const data = {
        labels: [
            'In-Bed Patients',
            'Deceased Patients',
            'Born Patients',
            'Discharged Patients'
        ],
        datasets: [{
            data: [
                {{ $totalInBedPatients }},
                {{ $totalDeceased }},
                {{ $totalBorn }},
                {{ $totalDischarged }}
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Config for the pie chart
    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Patient Distribution'
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    },
                    color: '#fff',
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // Render the pie chart
    window.onload = function() {
        const ctx = document.getElementById('patientPieChart').getContext('2d');
        new Chart(ctx, config);
    };
</script>


<!-- <script>
    // Data for the pie chart
    const data = {
        labels: [
            'In-Bed Patients',
            'Deceased Patients',
            'Born Patients',
            'Discharged Patients'
        ],
        datasets: [{
            data: [
                {{ $totalInBedPatients }},
                {{ $totalDeceased }},
                {{ $totalBorn }},
                {{ $totalDischarged }}
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Config for the pie chart
    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Patient Distribution'
                }
            }
        }
    };

    // Render the pie chart
    window.onload = function() {
        const ctx = document.getElementById('patientPieChart').getContext('2d');
        new Chart(ctx, config);
    };
</script> -->
@endsection
