@extends('frontend.master')
@section('registration')
active
@endsection

@section('page_header')
Register
@endsection

@section('page_name')
Register Form
@endsection
@section('content')

<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <div class="account-form form-style">
                    <form action="{{ route('user.registrationForm') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="name" name="name" class="form-control" id="name" placeholder="Enter Name">
                            @error('name')
                                <b class="text-danger">{{ $message }}</b>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                            @error('email')
                                <b class="text-danger">{{ $message }}</b>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"
                                id="password" placeholder="Enter New Password">
                            @error('password')
                                <b class="text-danger">{{ $message }}</b>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" placeholder="Enter Confirm Password">
                            @error('password_confirmation')
                                <b class="text-danger">{{ $message }}</b>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                            <div class="form-group col-lg-6">
                                <a href="#" class="btn d-block btn-primary">Or Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
