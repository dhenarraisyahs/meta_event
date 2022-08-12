@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Add New User') ,
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-body">
                    <form method="post" action="{{ route('user.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('User Information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email"
                                    class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="password">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    value="{{ old('password') }}" required autofocus>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="password">{{ __('Confirm Password') }}</label>
                                <div class="input-group input-group-alternative">
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                </div>
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