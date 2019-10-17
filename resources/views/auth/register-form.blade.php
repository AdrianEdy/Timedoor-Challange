@extends('auth.layout')

@section('content')
<div class="box login-box">
    <div class="login-box-head">
        <h1>Register</h1>
    </div>
    <form method="POST" action="{{ route('save.register') }}">
        @csrf
        <div class="login-box-body">
            <table class="table table-no-border">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>
                            <input type="text" style="border:0" name="name" value="{{ $request->name }}"
                                readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>
                            <input type="text" style="border:0" name="email" value="{{ $request->email }}"
                                readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>
                            <input type="text" style="border:0" name="password" value="{{ $request->password }}"
                                readonly="readonly">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="login-box-footer">
            <div class="text-right">
                <a href="{{ route('register') }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
@endsection