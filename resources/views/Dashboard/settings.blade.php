@extends('layout.main')
@section('content')

    <div class="login-page sp bg-cover" style="background-image: url(assets/img/bg/login-page-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-main-heading">
                        <div class="page-prog">
                            <a href="#">Home</a>
                            <span><i class="fa-solid fa-angle-right"></i></span>
                            <p class="bold">Settings</p>
                        </div>
                        <h1>Settings</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="login-form">

                        <form action="#">

                            <div class="single-input">
                                <label>Current Password</label>
                                <input type="password" placeholder="Enter current password" />
                            </div>
                            <div class="single-input">
                                <label>New Password</label>
                                <input type="password" placeholder="Enter new password" />
                            </div>
                            <div class="single-input">
                                <label>Confirm New Password</label>
                                <input type="password" placeholder="Confirm new password" />
                            </div>
                            <div class="button mt-30">
                                <button type="submit" class="theme-btn1">Change Password</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
