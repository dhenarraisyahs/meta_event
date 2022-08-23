@extends('attendance.layout')
@section('content')
    <form class="form-signin">
      <div class="text-center mb-4">
        <!-- <img class="mb-4" src="logo.png" alt="" width="128" height="128"> -->
        <h1 id="titleEvent" class="h3 mb-5 font-weight-normal">Corporate <br> Town Hall <br> Event</h1>
        <p style="font-size: large;">Berhasil check in</p>
      </div>

      <div class="my-4 mx-3 p-3 bg-white rounded box-shadow">
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">NIK</strong>
              <a href="#"><i class="fas fa-solid fa-hashtag"></i></a>
            </div>
            <span class="d-block">{{$attendance->participant->code}}</span>
          </div>
        </div>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">Nama</strong>
              <a href="#"><i class="fas fa-solid fa-user"></i></a>
            </div>
            <span class="d-block">{{$attendance->participant->name}}</span>
          </div>
        </div>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
          <div class="media-body pb-3 mb-0 small lh-125 border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">Waktu</strong>
              <a href="#"><i class="fas fa-solid fa-clock"></i></a>
            </div>
            <span class="d-block">{{$attendance->hour}}</span>
          </div>
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
                      window.location.href = "{{url('/check_in_result/')}}" + data.result_id;
                    }
                        
                  },
                  error: function (data) {

                  }
                });
            });
            
        });
    </script>
@endsection