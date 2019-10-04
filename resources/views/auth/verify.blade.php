@extends('layouts.app')

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

@section('style')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tmdrPreset.css') }}">
    <!-- CSS End -->
@endsection