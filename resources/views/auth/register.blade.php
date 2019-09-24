@extends('layouts.app')

@section('content')
    <div class="box login-box">
        <div class="login-box-head">
            <h1 class="mb-5">Register</h1>
        </div>
        <form method="POST" action="{{ route('confirm.register') }}">
        @csrf
            <div class="login-box-body">
                <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                @error('name')
                    <p class="small text-danger mt-5">{{ $message }}</p>
                @enderror
                </div>
                <div class="form-group">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                @error('email')
                    <p class="small text-danger mt-5">{{ $message }}</p>
                @enderror
                </div>
                <div class="form-group">
                <input type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password">
                @error('password')
                    <p class="small text-danger mt-5">{{ $message }}</p>
                @enderror
                </div>
            </div>
            <div class="login-box-footer">
                <div class="text-right">
                <a href="{{ route('home') }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-primary">
                    Confirm
                </button>
                </div>
            </div>
        </form>
    </div>
@endsection