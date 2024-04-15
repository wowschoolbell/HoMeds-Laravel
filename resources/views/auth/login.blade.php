@extends('layouts.login')

@section('content')
<main class="admin-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <div class="p-b-20 text-center">
                            <p>
                                <img src="{{ asset('theme/light/img/GAF-CW-logo.jpeg') }}" width="80" alt="">
                            </p>
                            <p class="admin-brand-content">
                                HoMEds
                            </p>
                        </div>

                        {{-- After Reset Password, Then stauts will set in session --}}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- After Reset Password, Then stauts will set in session --}}

                        <h3 class="text-center p-b-20 fw-400">{{ __('Login') }}</h3>
                        <form class="needs-validation" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                    <label for="login">{{ __('Username or E-Mail') }}</label>
                                    <input id="login" type="text" placeholder="Username or E-Mail" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                                    @if ($errors->has('username') || $errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group floating-label col-md-12">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group floating-label col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="custom-control-label" >
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg btn-red-dark">
                                {{ __('Login') }}
                            </button>
                        </form>
                        <p class="text-right p-t-10">
                            <a class="text-underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('theme/light/img/login-register.jpeg'); background-size: contain;">
            </div>
        </div>
    </div>
</main>
@endsection
