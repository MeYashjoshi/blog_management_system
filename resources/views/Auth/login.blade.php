@extends('frontend.layout.main')
@section('title', 'Login')
@section('content')
<!--===== CONTENT AREA START=======-->

	<div class="login-page sp bg-cover" style="background-image: url(assets/img/bg/login-page-bg.jpg)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="inner-main-heading">
						<div class="page-prog">
							<a href="/">Home</a>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p class="bold">Login</p>
						</div>
						<h1>Login</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 m-auto">
					<div class="login-form">
						<h3>Welcome Back</h3>
						<p>Please fill your email and password to sign in.</p>
						<form action="#">
							<div class="single-input">
								<label>Email</label>
								<input type="text" placeholder="Email address" />
							</div>
							<div class="single-input">
								<label>Password</label>
								<input type="password" placeholder="Enter your password" />
							</div>
							<div class="button mt-30">
								<button type="submit" class="theme-btn1">Sign In</button>
							</div>
							<div class="text-center">
								<p class="text">Don’t have an account? <a href="sigup">Sign Up Today.</a> <br /><a href="/forgot">Forgot Password</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== CONTENT AREA END=======-->
@endsection
