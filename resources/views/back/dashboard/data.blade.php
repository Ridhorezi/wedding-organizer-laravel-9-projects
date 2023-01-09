@extends('back.layouts.master', ['web' => $web])

@section('title_menu')
    Dashboard
@endsection

@section('title')
    Dashboard
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/owl-carousel/owl.carousel.css" rel="stylesheet') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .btn-faculty {
            background-color: #7A1F31;
            color: white;
        }

        .btn-faculty:hover {
            background-color: #852d3f;
            color: white;
        }

    </style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 col-xl-12 col-xxl-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-success  mr-md-4 mr-3">
                            <i class="fas fa-users" style="color: #27BC48;font-size: 25px;"></i>
                            </span>
                            <div class="media-body">
                                <p class="fs-14 mb-2">Total Akun</p>
                                <span class="title text-black font-w600">{{ $total_akun }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-success" style="width: 100%; height:5px;"
                                role="progressbar">
                                <span class="sr-only">42% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-success" style="top: 104px; left: -28px;"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-secondary  mr-md-4 mr-3">
                                <i class="fas fa-store-alt" style="color: #A02CFA;font-size: 25px;"></i>
                            </span>
                            <div class="media-body">
                                
                                <p class="fs-14 mb-2">Paket Wedding</p>
                                <span class="title text-black font-w600">{{ $total_paket_wedding }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-secondary" style="width: 100%; height:5px;"
                                role="progressbar">
                                <span class="sr-only">42% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-secondary" style="top: 104px; left: -28px;"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-danger mr-md-4 mr-3">
                                <i class="fas fa-shopping-basket" style="color: #FF3282;font-size: 25px;"></i>
                            </span>
                            <div class="media-body">
                                
                                <p class="fs-14 mb-2">Pemesanan</p>
                                <span class="title text-black font-w600">{{ $total_pemesanan }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-danger" style="width: 100%; height:5px;"
                                role="progressbar">
                                <span class="sr-only">42% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-danger" style="top: -15px; left: 275px;"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-warning  mr-md-4 mr-3">
                                <i class="fa-solid fa-cart-shopping" style="color: #FFBC11;font-size: 25px;"></i>
                            </span>
                            <div class="media-body">
                                
                                <p class="fs-14 mb-2">Pesanan Belum Dibayar</p>
                                <span class="title text-black font-w600">{{ $pesanan_belum_dibayar }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-warning" style="width: 100%; height:5px;"
                                role="progressbar">
                                <span class="sr-only">42% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-warning" style="top: 15px; left: -9px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>
    <script src="{{ asset('vendor/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Apex Chart -->

    <!-- Dashboard 1 -->
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script>
        // BAR CHART
        const bemChartArea = $('#bem_chart');
        const bpmChartArea = $('#bpm_chart');

        let dataBpm = {
            labels: bpmChartArea.data('bpmcandidates').split(','),
            datasets: [{
                label: 'PEROLEHAN SUARA',
                backgroundColor: [
                    "#27BC48",
                    "#A02CFA",
                    "#FF3282",
                    "#FFBC11"
                ],

                data: bpmChartArea.data('bpmvotings').split(',')
            }]
        };

        let dataBem = {
            labels: bemChartArea.data('bemcandidates').split(','),
            datasets: [{
                label: 'PEROLEHAN SUARA',
                backgroundColor: [
                    "#27BC48",
                    "#A02CFA",
                    "#FF3282",
                    "#FFBC11"
                ],

                data: bemChartArea.data('bemvotings').split(',')
            }]
        };


        var myBpmChart = new Chart(bpmChartArea, {
            type: 'pie',
            data: dataBpm,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    labels: {
                        render: 'percentage',
                        fontColor: '#ffffff',
                        precision: 2
                    }
                }
            }
        });

        var myBemChart = new Chart(bemChartArea, {
            type: 'pie',
            data: dataBem,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    labels: {
                        render: 'percentage',
                        fontColor: '#ffffff',
                        precision: 2
                    }
                }
            }
        });

        // myChart.options.animation = false;
        // END BAR CHART

        // PIE CHART
        // CHART FUNCTIONS
        // CHART FUNCTIONS
        function addBpmData(data) {
            myBpmChart.data.datasets.forEach((dataset) => {
                dataset.data = data;
            });

            myBpmChart.update();
        }

        function removeBpmData() {
            myBpmChart.data.datasets.forEach((dataset) => {
                dataset.data = null;
            });

            myBpmChart.update();
        }

        function addBemData(data) {
            myBemChart.data.datasets.forEach((dataset) => {
                dataset.data = data;
            });

            myBemChart.update();
        }

        function removeBemData() {
            myBemChart.data.datasets.forEach((dataset) => {
                dataset.data = null;
            });

            myBemChart.update();
        }

        setInterval(() => {
            $.getJSON('', null,
                function(data, textStatus, jqXHR) {
                    $('#bpmTotalVoter').text(data.total_voter);
                    $('#bpmHasVoted').text(`${data.bpm_has_voted.total} (${data.bpm_has_voted.percentage})`);
                    $('#bpmSudahMemilihBar').css({
                        'width': `${data.bpm_has_voted.percentage}`
                    });
                    $('#bpmUnvoted').text(`${data.bpm_unvoted.total} (${data.bpm_unvoted.percentage})`);
                    $('#bpmBelumMemilihBar').css({
                        'width': `${data.bpm_unvoted.percentage}`
                    });
                    $('#bpmTotalCandidate').text(data.total_candidate.bpm);

                    $('#bemTotalVoter').text(data.total_voter);
                    $('#bemHasVoted').text(`${data.bem_has_voted.total} (${data.bem_has_voted.percentage})`);
                    $('#bemSudahMemilihBar').css({
                        'width': `${data.bem_has_voted.percentage}`
                    });
                    $('#bemUnvoted').text(`${data.bem_unvoted.total} (${data.bem_unvoted.percentage})`);
                    $('#bemBelumMemilihBar').css({
                        'width': `${data.bem_unvoted.percentage}`
                    });
                    $('#bemTotalCandidate').text(data.total_candidate.bem);

                    data.bpmVotings.pop()
                    data.bemVotings.pop()

                    // removeBpmData()
                    // removeBemData()
                    addBpmData(data.bpmVotings)
                    addBemData(data.bemVotings)

                }
            );

        }, 1000);
    </script>
@endsection
