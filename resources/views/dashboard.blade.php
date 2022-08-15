@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">

            <div class="col-xl-4 mb-5 mb-xl-0">
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
            <div class="col-xl-8">
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

    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">
        var tableAttendance;
        var tableTitle;
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

                        const ctx = document.getElementById('chart-attendance-' + i).getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'pie',
                            data : {
                                labels: [
                                    'Belum Hadir',
                                    'Hadir'
                                ],
                                datasets: [{
                                    label: 'My First Dataset',
                                    data: [(value.undangan - value.hadir), value.hadir],
                                    backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)'
                                    ],
                                    hoverOffset: 4
                                }],
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false
                                }
                            }
                        });
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