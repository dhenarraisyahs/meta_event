@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-6 mb-5 mb-xl-0">
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
                                    <th scope="col">NIK</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Waktu Scan</th>
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
        </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">
        $(function () {
            var tableLocation = $('#tableLocation').DataTable({
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

            var tableAttendance = $('#tableAttendance').DataTable({
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
                                    data: 'code', 
                                    name: 'code'
                                }, 
                                {
                                    data: 'location', 
                                    name: 'location'
                                }, 
                                {
                                    data: 'hour', 
                                    name: 'hour'
                                }
                            ],
                        language: {
                            paginate: {
                                previous: "<i class='fas fa-angle-left'>",
                                next: "<i class='fas fa-angle-right'>"
                            }
                        },
                     });
        });
    </script>
@endpush