@extends('layouts.login')

@section('content')
<main class="admin-main  custom-pattern">
    <div class="container">
        <div class="row m-h-100 ">
            <div class="col-md-8 col-lg-6  m-auto">
                <div class="card shadow-lg ">
                    <div class="card-body reset-password-section">
                        <div class=" padding-box-2 ">
                            <div class="text-center p-b-20 pull-up-sm">
                                <div class="avatar avatar-lg custom-logo">
                                    <span class="avatar-title rounded-circle bg-pink custom-logo">
                                        <!-- <i class="mdi mdi-key-change"></i> -->
                                        <img src="{{ asset('theme/light/img/vpslogo.png') }}" width="80" alt="" class="custom-logo">
                                    </span>
                                </div>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h3 class="text-center">{{ __('Reset Password') }}</h3>
                            <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                                @csrf
                                <div class="form-group">
                                    <!-- <label for="email">{{ __('Email') }}</label> -->

                                    <div class="input-group input-group-flush mb-3 input-height">
                                        <input placeholder="yourmail@example.com" id="email" type="email" class="input-height form-control form-control-prepended{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class=" mdi mdi-email "></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <p class="small">
                                        We will send a reset link to your registered E-Mail
                                    </p>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn text-uppercase btn-block  btn-primary btn-red-dark">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </form>
                            <p class="text-center p-t-10">
                                <a href="{{ route('login') }}" class="text-underline custom-link">
                                    Back to Login
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
