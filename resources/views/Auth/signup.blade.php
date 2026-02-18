@extends('frontend.layout.main')
@section('title', 'Sign Up')
@section('content')

    <!--===== CONTENT AREA START=======-->

    <div class="login-page sp bg-cover" style="background-image: url(assets/img/bg/login-page-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-main-heading">
                        <div class="page-prog">
                            <a href="#">Home</a>
                            <span><i class="fa-solid fa-angle-right"></i></span>
                            <p class="bold">Sign Up</p>
                        </div>
                        <h1>Sign Up</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="login-form">
                        <h3>Create Your Account</h3>
                        <p>Create an account today and start using Vexon</p>
                        <form action="{{ route('signup') }}" id="signupForm" method="post">
                            @csrf

                            <div class="single-input">
                                <label>First Name</label>
                                <input type="text" placeholder="Your first name" id="firstname" name="firstname"
                                    value="{{ old('firstname') }}" required />
                                @error('firstname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="single-input">
                                <label>Last Name</label>
                                <input type="text" placeholder="Your last name" id="lastname" name="lastname"
                                    value="{{ old('lastname') }}" required />
                                @error('lastname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="single-input">
                                <label>Email</label>
                                <input type="text" placeholder="Email address" id="email" name="email"
                                    value="{{ old('email') }}" required />
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="single-input">
                                <label>Password</label>
                                <input type="password" placeholder="Enter your password" id="password" name="password"
                                    required />
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="single-input">
                                <label>Confirm Password</label>
                                <input type="password" placeholder="Confirm your password" id="confirm_password"
                                    name="confirm_password" required />
                                @error('confirm_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="button mt-30">
                                <button type="submit" class="theme-btn1">Create An Account</button>
                            </div>
                            <div class="text-start">
                                <p class="text"><input type="checkbox" name="checkbox1" id="checkbox1" value="1" {{ old('checkbox1') ? 'checked' : '' }} /> <label aria-colspan="checkbox1"
                                        for="checkbox1">I have read and agree to the </label><a href="#">Terms &
                                        Consitions.</a></p>
                                @error('checkbox1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== CONTENT AREA END=======-->
@endsection