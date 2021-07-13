@extends('frontend.master')
@section('login')
active
@endsection

@section('page_header')
Login
@endsection

@section('page_name')
Account Login
@endsection
@section('content')
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <div class="account-form form-style">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                            @error('email')
                                <b class="text-danger">{{ $message }}</b>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"
                                id="password" placeholder="Enter Password">
                            @error('password')
                                <b class="text-danger">{{ $message }}</b>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Save Password</label>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="{{ route('password.request') }}">Forget Your Password?</a>
                            </div>
                        </div>
                        <button >SIGN IN</button>
                        <div class="text-center">
                            <a href="register.html">Or Creat an Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
