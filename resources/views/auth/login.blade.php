@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background: #F8F9FA;">
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-md-7 col-lg-5 col-xl-4">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden" style="background: #fff;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mt-2 mb-1" style="color:#2874A6; letter-spacing:1px;">{{ __('Login') }}</h2>
                        <p class="text-muted mb-0" style="font-size:1.05rem;">Welcome back! Please sign in to your account</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold" style="color:#2874A6;">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg rounded-4 shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background: #F4F6F7; border: 1.5px solid #D6DBDF;">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold" style="color:#2874A6;">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg rounded-4 shadow-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background: #F4F6F7; border: 1.5px solid #D6DBDF;">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color:#2874A6;">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-lg rounded-pill fw-bold shadow-sm" style="background: linear-gradient(90deg, #2874A6 60%, #5499C7 100%); color: #fff; letter-spacing:1px;">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="text-center mt-2">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none px-0" style="color: #2874A6; font-weight: 500;" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
