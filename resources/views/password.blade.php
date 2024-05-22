


@extends('layouts.login')

<meta name="viewport" content="width=device-width, initial-scale=1">
@section('content')
<main class="admin-main">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-6 d-none d-md-block bg-cover video-container">
                
                 <video autoplay muted loop id="video-background">
                      <source
                        src="/public/video/WhatsApp-Video.mp4"
                        type="video/mp4" />
                      Your browser does not support the video tag.
                    </video>
            </div>
            <div class="col-lg-6">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <div class="p-b-20 text-center">
                            <!--<p>-->
                            <!--    <img src="{{ asset('theme/light/img/GAF-CW-logo.png') }}" style="width: 200px; height: 200px;" alt="">-->
                            <!--</p>-->
                            <!-- <p class="admin-brand-content">
                                HoMEds
                            </p> -->
                        </div>

                

                        <p class="text-center" style="font-size: 30px;font-weight: 500;margin-bottom: 5px;color:black">{{ __('Reset Password') }}</p>
                         <form method="POST" action="{{ url('passwordreset') }}">
                        @csrf


                        <!-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div> -->
                        <input name="hash" type="hidden" class="form-control @error('email') is-invalid @enderror" name="hash" value="{{ $PasswordLink->hash }}" required autocomplete="email" autofocus>

                         <input name="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<style>
    
</style>




