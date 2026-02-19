@extends('frontend.layout.main')
@section('title', 'Reset Password')
@section('content')

<!--===== CONTENT AREA START=======-->

<div class="login-page sp bg-cover" style="background-image: url(assets/img/bg/login-page-bg.jpg)">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="inner-main-heading">
					<div class="page-prog">
						<a href="index.html">Home</a>
						<span><i class="fa-solid fa-angle-right"></i></span>
						<p class="bold">Reset Password</p>
					</div>
					<h1>Reset Password</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 m-auto">
				<div class="login-form">
					<div class="text-center">
						<div class="forgot-icon">
							<img src="assets/img/icons/reset.svg" alt="vexon" />
						</div>
						<h3 class="mt-20">Reset Password</h3>
						<p>If you want to reset your password, please enter your new password below.</p>
					</div>
					<form action="{{ route('resetpassword') }}" method="POST">
						@csrf
						<input type="hidden" name="token" value="{{ $token }}">
						<input type="hidden" name="email" value="{{ $email }}">
						<div class="single-input">
							<label>New Password</label>
							<input type="password" name="password" placeholder="New Password" required />
						</div>
						<div class="single-input">
							<label>Confirm Password</label>
							<input type="password" name="password_confirmation" placeholder="Confirm Password"
								required />
						</div>
						<div class="button mt-30">
							<button type="submit" class="theme-btn1">Change Password</button>
						</div>
						<div class="text-center">
							<p class="text">If you didn’t request a password recovery link, please ignore this.</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!--===== CONTENT AREA END=======-->