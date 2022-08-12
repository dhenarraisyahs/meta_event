@extends('layouts.app')

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
                            <h3 class="mb-0">Billing Management</h3>
                        </div>
                        {{-- <div class="col-4 text-right">
                            <a href="{{ route('tenant.create') }}" class="btn btn-sm btn-primary">Add Tenant</a>
                        </div> --}}
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Tenant Name</th>
                                <th scope="col">Amount of Bill</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($tenants as $tenant) --}}
                            <tr>
                                {{-- <td>{{ $tenant->tenant_name }}</td> --}}
                                {{-- <td>{{ $tenant->tenant_server }}</td> --}}
                                {{-- <td>{{ $tenant->tenant_pic }}</td> --}}
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <?php  //dd($tenant);?>
                                            {{-- <a class="dropdown-item"
                                                href="{{ route('tenant.edit',$tenant->id) }}">Edit</a>
                                            <a class="dropdown-item" href="{{ route('tenant.show',$tenant->id) }}">Detail</a> --}}
                                           
                                            {{-- <form action="{{ route('tenant.destroy',$tenant->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item" onclick="return confirm('Are you sure want to delete this item?')">Delete</button>
                                            </form> --}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
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
@endsection