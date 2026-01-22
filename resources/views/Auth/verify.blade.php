@extends('layout.main')
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
							<p class="bold">Verify Your Email</p>
						</div>
						<h1>Verify Your Email</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 m-auto">
					<div class="login-form">
						<div class="text-center">
							<div class="forgot-icon">
								<img src="assets/img/icons/verify.svg" alt="vexon" />
							</div>
							<h3 class="mt-20">Verify Your Email!</h3>
							<p>We sent you a verification link via email. Please click it to verify your email address if you don’t see it, please wait up to 5 mins or check your SPAM folder.</p>
						</div>
						<form action="#">
							<div class="button mt-30">
								<button type="submit" class="theme-btn1">Open Email</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== CONTENT AREA END=======-->

@endsection
