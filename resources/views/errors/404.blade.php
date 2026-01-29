@extends('frontend.layout.main')
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
							<p class="bold">Page not found</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 m-auto">
					<div class="login-form">
						<div class="text-center">
							<div class="forgot-icon">
								<img src="assets/img/shapes/404.png" alt="vexon" />
							</div>
							<h3 class="mt-5 mb-2">Error 404</h3>
							<p class="mb-5">This page is outside of the universe</p>
							<button type="submit" class="theme-btn1">Back to Home</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== CONTENT AREA END=======-->

@endsection
