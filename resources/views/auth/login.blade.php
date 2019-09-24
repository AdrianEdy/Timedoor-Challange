@extends('layouts.app')

@section('content')
<div class="container">
    <div class="box login-box">
        <div class="login-box-head">
            <h1 class="mb-5">Login</h1>
        </div>
        <div class="login-box-body">
            <div class="form-group">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @error('verified')
                        <div class="form-group" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">
                            {{ __('E-Mail Address') }}
                        </label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <p class="small text-danger mt-5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            required autocomplete="current-password">
                            @error('password')
                                <p class="small text-danger mt-5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
