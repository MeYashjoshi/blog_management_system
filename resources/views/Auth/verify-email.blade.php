@extends('frontend.layout.main')
@section('title', 'Verify Email')
@section('content')

    <div class="login-page sp bg-cover" style="background-image: url({{ asset('assets/img/bg/login-page-bg.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-main-heading">
                        <div class="page-prog">
                            <a href="/">Home</a>
                            <span><i class="fa-solid fa-angle-right"></i></span>
                            <p class="bold">Verify Email</p>
                        </div>
                        <h1>Verify Your Email Address</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="login-form">
                        <h3>Verify Your Email</h3>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                A fresh verification link has been sent to your email address.
                            </div>
                        @else
                            <p>Before proceeding, please check your email for a verification link.</p>
                            <p>If you did not receive the email,</p>
                        @endif

                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="button mt-30 text-center">
                                <button type="submit" class="theme-btn1">Click here to request another</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection