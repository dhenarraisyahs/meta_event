@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Merchant Billing') ,
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-body">
                    <form method="post" action="{{ route('tenant.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('Billing Information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group{{ $errors->has('merchant_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="merchant_id">{{ __('Merchant') }}</label>
                                        <input type="text" name="merchant_id" id="merchant_id"
                                            class="form-control form-control-alternative{{ $errors->has('merchant_id') ? ' is-invalid' : '' }}"
                                            value="{{ old('merchant_id') }}" required autofocus>

                                        @if ($errors->has('merchant_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('merchant_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group{{ $errors->has('billing_periode') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="billing_periode">{{ __('Periode') }}</label>
                                        <input type="text" name="billing_periode" id="billing_periode"
                                            class="form-control form-control-alternative{{ $errors->has('billing_periode') ? ' is-invalid' : '' }}"
                                            value="{{ old('billing_periode') }}" required autofocus>

                                        @if ($errors->has('billing_periode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('billing_periode') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('merchant_email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="merchant_email">{{ __('Email') }}</label>
                                <input type="text" name="merchant_email" id="merchant_email"
                                    class="form-control form-control-alternative{{ $errors->has('merchant_email') ? ' is-invalid' : '' }}"
                                    value="{{ old('merchant_email') }}" required autofocus>

                                @if ($errors->has('merchant_email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('merchant_email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group{{ $errors->has('billing_price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="billing_price">{{ __('Total Users') }}</label>
                                        <input type="text" name="billing_price" id="billing_price"
                                            class="form-control form-control-alternative{{ $errors->has('billing_price') ? ' is-invalid' : '' }}"
                                            value="{{ old('billing_price') }}" required autofocus>

                                        @if ($errors->has('billing_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('billing_price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group{{ $errors->has('billing_price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="billing_price">{{ __('Attendances') }}</label>
                                        <input type="text" name="billing_price" id="billing_price"
                                            class="form-control form-control-alternative{{ $errors->has('billing_price') ? ' is-invalid' : '' }}"
                                            value="{{ old('billing_price') }}" required autofocus>

                                        @if ($errors->has('billing_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('billing_price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('billing_price') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="billing_price">{{ __('Unit Price') }}</label>
                                <input type="text" name="billing_price" id="billing_price"
                                    class="form-control form-control-alternative{{ $errors->has('billing_price') ? ' is-invalid' : '' }}"
                                    value="{{ old('billing_price') }}" required autofocus>

                                @if ($errors->has('billing_price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('billing_price') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('billing_total') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="billing_total">{{ __('Total') }}</label>
                                <input type="text" name="billing_total" id="billing_total"
                                    class="form-control form-control-alternative{{ $errors->has('billing_total') ? ' is-invalid' : '' }}"
                                    value="{{ old('billing_total') }}" required autofocus>

                                @if ($errors->has('billing_total'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('billing_total') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div>
                                <a class="btn btn-info mt-4" href="{{ URL::previous() }}">Back</a>
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