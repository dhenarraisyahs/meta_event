@extends('attendance.layout')
@section('content')
    <form id="CreateForm" class="form-signin">
      <div class="text-center mb-4">
        <!-- <img class="mb-4" src="logo.png" alt="" width="128" height="128"> -->
        <h1 id="titleEvent" class="h3 mb-5 font-weight-normal">Corporate <br> Town Hall <br> Event</h1>
        <p style="font-size: large;">Selamat datang,<br> silakan masukan No NIK anda.</p>
      </div>
      <input type="hidden" id="inputId" name="id"  autofocus>
      <input type="hidden" id="inputLocation" name="location_id" value="{{$location_id}}" autofocus>
      <div class="form-label-group mt-5 mx-3">
        <input type="text" id="inputEmail" class="form-control" placeholder="No NIK" name="participant_code">
        <label for="inputEmail">No NIK</label>
      </div>

      <div class="form-label-group mx-3">
        <button id="saveBtn" class="btn btn-lg btn-warning btn-block" type="submit">CHECK IN</button>
      </div>
      <div class="row justify-content-center">
          <div class="col-6 align-content-center text-center">
              <img src="{{ asset('img') }}/logo-gmi.png" style="height: 36px;" class="navbar-brand-img" alt="...">
              <img src="{{ asset('img') }}/logo-indosat.png" style="height: 64px;" class="navbar-brand-img" alt="...">
          </div>
      </div>
      <p  style="font-size: small;" class="mt-5 mb-3 text-muted text-center">&copy; 2022 Metamorfive</p>
    </form>


    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                var formData = new FormData($('#CreateForm')[0]);
                $.ajax({
                  data: $('#CreateForm').serialize(),
                  url: "{!! route('attendance.store') !!}",
                  type: "POST",
                  data: formData,
                  dataType: 'json',
                  cache:false,
                  contentType: false,
                  processData: false,
                  success: function (data) {
                    if (!data.success) {
                      alert(data.message);
                    } else {
                      window.location.href = "{{url('/check_in_result')}}/" + data.result_id;
                    }
                        
                  },
                  error: function (data) {

                  }
                });
            });
            
        });
    </script>
@endsection