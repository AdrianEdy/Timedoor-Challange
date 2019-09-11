@extends('layouts.app')

@section('content')
    <div class="box login-box">
            <div class="login-box-head">
                <h1 class="mb-5">Membership Register</h1>
            </div>
            <div class="login-box-body">
                Thank you for your membership register.<br/>
                We send confirmation e-mail to you. Please complete the registration by clicking
                the confirmation URL.
            </div>
            <div class="login-box-footer">
                <div class="text-center">
                    <a href="/" class="btn btn-primary">Back</a>
                </div>
            </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="box login-box">
        <div class="login-box-head">
            <h1 class="mb-5">Register</h1>
            <p class="text-lgray">Please fill the information below...</p>
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
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-primary">
                    Confirm
                </button>
                </div>
            </div>
        </form>
    </div>
@endsection
