<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                @foreach ($locations as $index => $value)
                <div class="col-xl-2 col-lg-6 mb-4">
                    <a href="#" onclick="setTableTitle({{$value->id}}); setTableAttendance({{$value->id}}); return false;">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body m--3">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-center mb-0 mt-2">{{ $value->name }}</h5>
                                    </div>
                                </div>
                                <div class="chart" style="height:200px">
                                    <!-- Chart wrapper -->
                                    <div id="chart-attendance-{{$index}}" style="height:200px" class="chart-canvas"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>