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
						<form action="#">
							<div class="single-input">
								<label>Name</label>
								<input type="text" placeholder="Your name" />
							</div>
							<div class="single-input">
								<label>Email</label>
								<input type="text" placeholder="Email address" />
							</div>
							<div class="single-input">
								<label>Password</label>
								<input type="password" placeholder="Enter your password" />
							</div>
							<div class="button mt-30">
								<button type="submit" class="theme-btn1">Create An Account</button>
							</div>
							<div class="text-start">
								<p class="text"><input type="checkbox" name="checkbox1" id="checkbox1" /> <label aria-colspan="checkbox1" for="checkbox1">I have read and agree to the </label><a href="#">Terms & Consitions.</a></p>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== CONTENT AREA END=======-->
    @endsection
