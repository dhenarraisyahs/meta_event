@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">

            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Location</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <!-- Projects table -->
                        <table id="tableLocation" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Undangan</th>
                                    <th scope="col">Kehadiran</th>
                                    <th scope="col">Belum Hadi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-5 mb-xl-0 d-none">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Title</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <!-- Projects table -->
                        <table id="tableTitle" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Kehadiran</th>
                                    <th scope="col">Belum Hadir</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Attendance</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <!-- Projects table -->
                        <table id="tableAttendance" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Waktu Scan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <div id="chartnya"></div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">
        var tableAttendance;
        var tableTitle;
        var tableLocation;
        function setTableTitle(location_id) {
            var params = '';
            if (location_id) {
                params = '?location_id=' + location_id;
            }
            tableTitle.ajax.url('{!! route('participant.statistic') !!}' + params);
            tableTitle.ajax.reload();
        }

        function setTableAttendance(location_id) {
            var params = '';
            if (location_id) {
                params = '?location_id=' + location_id;
            }
            tableAttendance.ajax.url('{!! route('attendance.list') !!}' + params);
            tableAttendance.ajax.reload();
        }

        function setChart() {
            $.ajax({
                url: "{!! route('location.statistic') !!}",  
                success: function(data) {
                    data.data.forEach(function (value, i) {

                        // Build the chart
                        Highcharts.chart('chart-attendance-'+i, {
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: ''
                            },
                            tooltip: {
                                pointFormat: '{point.percentage:.1f}%'
                            },
                            accessibility: {
                                point: {
                                    valueSuffix: '%'
                                }
                            },
                            legend: {
                                labelFormat: '{name} {y}'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    colors: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)'
                                        ],
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.percentage:.1f} %',
                                        distance: -50,
                                        filter: {
                                            property: 'percentage',
                                            operator: '>',
                                            value: 4
                                        }
                                    },
                                    showInLegend: true,
                                }
                            },
                            series: [{
                                name: 'Share',
                                data: [
                                    { name: 'Belum Hadir', y: (value.undangan - value.hadir) },
                                    { name: 'Hadir', y: value.hadir },
                                ]
                            }]
                        });

                        // const ctx = document.getElementById('chart-attendance-' + i).getContext('2d');
                        // const myChart = new Chart(ctx, {
                        //     type: 'pie',
                        //     data : {
                        //         labels: [
                        //             'Belum Hadir',
                        //             'Hadir'
                        //         ],
                        //         datasets: [{
                        //             label: 'My First Dataset',
                        //             data: [(value.undangan - value.hadir), value.hadir],
                        //             backgroundColor: [
                        //             'rgb(255, 99, 132)',
                        //             'rgb(54, 162, 235)'
                        //             ],
                        //             hoverOffset: 4
                        //         }],
                        //         options: {
                        //             responsive: true,
                        //             maintainAspectRatio: false,
                        //             events: false,
                        //             animation: {
                        //                 duration: 500,
                        //                 easing: "easeOutQuart",
                        //                 onComplete: function () {
                        //                 var ctx = this.chart.ctx;
                        //                 ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                        //                 ctx.textAlign = 'center';
                        //                 ctx.textBaseline = 'bottom';

                        //                 this.data.datasets.forEach(function (dataset) {

                        //                     for (var i = 0; i < dataset.data.length; i++) {
                        //                     var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                        //                         total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                        //                         mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
                        //                         start_angle = model.startAngle,
                        //                         end_angle = model.endAngle,
                        //                         mid_angle = start_angle + (end_angle - start_angle)/2;

                        //                     var x = mid_radius * Math.cos(mid_angle);
                        //                     var y = mid_radius * Math.sin(mid_angle);

                        //                     ctx.fillStyle = '#fff';
                        //                     if (i == 3){ // Darker text color for lighter background
                        //                         ctx.fillStyle = '#444';
                        //                     }
                        //                     var percent = String(Math.round(dataset.data[i]/total*100)) + "%";      
                        //                     //Don't Display If Legend is hide or value is 0
                        //                     if(dataset.data[i] != 0 && dataset._meta[0].data[i].hidden != true) {
                        //                         ctx.fillText(dataset.data[i], model.x + x, model.y + y);
                        //                         // Display percent in another line, line break doesn't work for fillText
                        //                         ctx.fillText(percent, model.x + x, model.y + y + 15);
                        //                     }
                        //                     }
                        //                 });               
                        //                 }
                        //             }
                        //         }
                        //     }
                        // });
                    });
                    
                }
            });
            
        }


        $(function () {
            tableAttendance = $('#tableAttendance').DataTable({
                        processing: true,
                        // serverSide: true,
                        pageLength: 5,
                        lengthChange:false,
                        ajax: '{!! route('attendance.list') !!}',
                        order: [[3, 'desc']],
                        columns: [
                                {
                                    data: 'name', 
                                    name: 'name'
                                },
                                {
                                    data: 'title', 
                                    name: 'title'
                                }, 
                                {
                                    data: 'code', 
                                    name: 'code'
                                }, 
                                {
                                    data: 'location', 
                                    name: 'location'
                                }, 
                                {
                                    data: 'attendance', 
                                    name: 'attendance'
                                }
                            ],
                        language: {
                            paginate: {
                                previous: "<i class='fas fa-angle-left'>",
                                next: "<i class='fas fa-angle-right'>"
                            }
                        },
                     });

            tableLocation = $('#tableLocation').DataTable({
                        processing: true,
                        // serverSide: false,
                        pageLength: 5,
                        lengthChange:false,
                        ajax: '{!! route('location.statistic') !!}',
                        columns: [
                                {
                                    data: 'name', 
                                    name: 'name'
                                },
                                {
                                    data: 'undangan', 
                                    name: 'undangan'
                                }, 
                                {
                                    data: 'hadir', 
                                    name: 'hadir'
                                }, 
                                {
                                    data: 'action', 
                                    name: 'action'
                                }
                            ],
                        language: {
                            paginate: {
                                previous: "<i class='fas fa-angle-left'>",
                                next: "<i class='fas fa-angle-right'>"
                            }
                        },
                     });


            tableTitle = $('#tableTitle').DataTable({
                        processing: true,
                        // serverSide: false,
                        pageLength: 5,
                        lengthChange:false,
                        ajax: '{!! route('participant.statistic') !!}',
                        columns: [
                                {
                                    data: 'title', 
                                    name: 'title'
                                },
                                {
                                    data: 'hadir', 
                                    name: 'hadir'
                                }, 
                                {
                                    data: 'action', 
                                    name: 'action'
                                }
                            ],
                        language: {
                            paginate: {
                                previous: "<i class='fas fa-angle-left'>",
                                next: "<i class='fas fa-angle-right'>"
                            }
                        },
                     });
            
            setChart();  

            setInterval(function(){ 
                tableTitle.ajax.reload();
                tableAttendance.ajax.reload();
                setChart();  
            }, 5000);

            
        });
    </script>
@endpush