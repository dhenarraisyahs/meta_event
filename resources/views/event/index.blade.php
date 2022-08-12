@extends('layouts.app')
{{-- @push('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush --}}
@section('content')
<!-- Top navbar -->

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">


    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Event Management</h3>
                        </div>
                        <div class="col-4 text-right">
                            {{-- <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary">Add Data</a> --}}
                            <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#createModal">Tambah</button>
                        </div>
                        
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="bootstrap-data-table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Is Active?</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    © 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative
                        Tim</a> &amp;
                    <a href="https://www.updivision.com" class="font-weight-bold ml-1" target="_blank">Updivision</a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.updivision.com" class="nav-link" target="_blank">Updivision</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md"
                            class="nav-link" target="_blank">MIT License</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Form Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="CreateForm" name="CreateForm" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="name" class=" form-control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}" maxlength="50" >
                    </div>
                    <div class="form-group">
                        <label for="logo" class=" form-control-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ old('date') }}">
                    </div>
                    <div class="form-group">
                        <label for="is_active" class=" form-control-label">Is Active</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')

<script type="text/javascript">
    $(function () {
        // alert('12345');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#bootstrap-data-table').DataTable({
                        processing: true,
                        //serverSide: false,
                        ajax: '{!! route('event.list') !!}',
                        columns: [
                                {
                                    data: 'id', 
                                    name: 'id'
                                },
                                {
                                    data: 'name', 
                                    name: 'name'
                                }, 
                                {
                                    data: 'date', 
                                    name: 'date'
                                },           
                                {
                                    data: 'is_active', 
                                    name: 'is_active'
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

        $('body').on('click', '.editRecord', function () {
            var id = $(this).data('id');
            $.get('event/' + id +'/edit', function (data) {
                $('#smallmodalLabel').html("Edit Data");
                $('#saveBtn').val("edit-data");
                $('#createModal').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#date').val(data.date);
                $('#is_active').val(data.is_active);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            console.log("masuk save");
            var formData = new FormData($('#CreateForm')[0]);
            $.ajax({
            data: $('#CreateForm').serialize(),
            url: "{!! route('event.store') !!}",
            type: "POST",
            data: formData,
            dataType: 'json',
                cache:false,
            contentType: false,
            processData: false,
            success: function (data) {

                $('#CreateForm').trigger("reset");
                $('#createModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                table.ajax.reload();
                alert(data.success);  
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
            });
        });

        $('body').on('click', '.deleteRecord', function () {
            // var token = $("meta[name='csrf-token']").attr("content");
            var id = $(this).data("id");
            confirm("Are You sure want to delete ?");

            $.ajax({
            type: "DELETE",
            url: "event/"+id,
            
            success: function (data) {
                table.ajax.reload();
                alert(data.success);
            },
            error: function (data) {
                alert('Error:', data);
            }
            });
        });
        
    });
</script>
@endpush