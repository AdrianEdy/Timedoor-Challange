@extends('auth.layout')

@section('content')
<div class="box login-box">
    <div class="login-box-head">
        <h1 class="mb-5">Membership Register</h1>
    </div>
    <div class="login-box-body">
        {{ $message }}
    </div>
    <div class="login-box-footer">
        <div class="text-center">
            <a href="/" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection