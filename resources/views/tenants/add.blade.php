@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Add New Tenant') ,
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-body">
                    <form method="post" action="{{ route('tenant.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('Tenant Information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('tenant_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_name">{{ __('Tenant Name') }}</label>
                                <input type="text" name="tenant_name" id="tenant_name"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_name') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_name') }}" required autofocus>

                                @if ($errors->has('tenant_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tenant_server') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_server">{{ __('Server') }}</label>
                                <input type="text" name="tenant_server" id="tenant_server"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_server') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_server') }}" required autofocus>

                                @if ($errors->has('tenant_server'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_server') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tenant_dbname') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_dbname">{{ __('Database Name') }}</label>
                                <input type="text" name="tenant_dbname" id="tenant_dbname"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_dbname') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_dbname') }}" required autofocus>

                                @if ($errors->has('tenant_dbname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_dbname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tenant_username') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_username">{{ __('Database Username') }}</label>
                                <input type="text" name="tenant_username" id="tenant_username"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_username') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_username') }}" required autofocus>

                                @if ($errors->has('tenant_username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tenant_password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_password">{{ __('Database Password') }}</label>
                                <input type="text" name="tenant_password" id="tenant_username"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_password') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_password') }}" required autofocus>

                                @if ($errors->has('tenant_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tenant_pic') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_pic">{{ __('PIC') }}</label>
                                <input type="text" name="tenant_pic" id="tenant_pic"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_pic') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_pic') }}" required autofocus>

                                @if ($errors->has('tenant_pic'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_pic') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tenant_nohp') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_nohp">{{ __('No HP') }}</label>
                                <input type="text" name="tenant_nohp" id="tenant_nohp"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_nohp') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_nohp') }}" required autofocus>

                                @if ($errors->has('tenant_nohp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_nohp') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tenant_email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="tenant_email">{{ __('Email') }}</label>
                                <input type="text" name="tenant_email" id="tenant_email"
                                    class="form-control form-control-alternative{{ $errors->has('tenant_email') ? ' is-invalid' : '' }}"
                                    value="{{ old('tenant_email') }}" required autofocus>

                                @if ($errors->has('tenant_email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tenant_email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection