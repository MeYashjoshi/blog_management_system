@extends('frontend.layout.main')



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
							<p class="bold">Forgot Password</p>
						</div>
						<h1>Forgot Password</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 m-auto">
					<div class="login-form">
						<div class="text-center">
							<div class="forgot-icon">
								<img src="assets/img/icons/forgot-icon.svg" alt="vexon" />
							</div>
							<h3 class="mt-20">Forgot Your Password?</h3>
							<p>If you forgot your password, please enter your email below and we will send you a recovery
								link.</p>
						</div>
						<form action="{{ route('sendpasswordresetlink') }}" method="POST">
							@csrf
							<div class="single-input">
								<label>Email Address</label>
								<input type="email" name="email" placeholder="Email Address" required />
							</div>
							<div class="button mt-30">
								<button type="submit" class="theme-btn1">Send Recovery Link</button>
							</div>
							<div class="text-center">
								<p class="text"><label> Remember your password? </label><a href="/login">Login</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== CONTENT AREA END=======-->
@endsection