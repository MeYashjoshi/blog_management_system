@extends('frontend.layout.main')

@section('title', 'Contact Us')

@section('hero_area')

<div class="inner-hero bg-cover" style="background-image: url(assets/img/bg/inner-hero-bg.jpg)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-heading">
						<div class="page-prog">
							<a href="index.html">Home</a>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p>Blog</p>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p class="bold">Contact Us</p>
						</div>
						<h1>Contact Us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection




@section('content')

	<!--===== CONTACT AREA START=======-->

	<div class="contact-page-sec sp">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 m-auto">
					<div class="heading1 text-center">
						<h2>We’d Love to Hear From You</h2>
						<p class="mt-16">Whether you have questions, feedback, or just want to say hello, we’re here to connect. Your thoughts and insights help us make Vexon better every day, and we’re always excited to hear from our readers.</p>
					</div>

					<div class="contact-page-from">
						<div class="heading1">
							<h5>Write Message</h5>
							<p class="mt-10">Provide clear contact information, including phone number, email, and address.</p>
						</div>
						<form action="#">
							<div class="row">
								<div class="col-md-6">
									<div class="single-input">
										<input type="text" placeholder="First Name" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="single-input">
										<input type="text" placeholder="Last Name" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="single-input">
										<input type="email" placeholder="Email" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="single-input">
										<input type="number" placeholder="Phone" />
									</div>
								</div>

								<div class="col-md-12">
									<div class="single-input">
										<input type="text" placeholder="Subject" />
									</div>
								</div>

								<div class="col-md-12">
									<div class="single-input">
										<textarea rows="5" placeholder="Message"></textarea>
									</div>
									<div class="button mt-30">
										<button class="theme-btn1" type="submit">Send Message</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="row pt-20">
						<div class="col-lg-4 col-md-6">
							<div class="contact-page-box">
								<div class="icon">
									<img src="assets/img/icons/contact-page-box1.svg" alt="vexon" />
								</div>
								<div class="heading">
									<h4>Send Email</h4>
									<a href="mailto:support@vexon.com">support@vexon.com</a>
									<a href="mailto:contact@vexon.com">contact@vexon.com</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6">
							<div class="contact-page-box">
								<div class="icon">
									<img src="assets/img/icons/contact-page-box2.svg" alt="vexon" />
								</div>
								<div class="heading">
									<h4>Office Address</h4>
									<a href="#">8708 Technology Forest Pl Suite 125 -G, The Woodlands</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6">
							<div class="contact-page-box">
								<div class="icon">
									<img src="assets/img/icons/contact-page-box3.svg" alt="vexon" />
								</div>
								<div class="heading">
									<h4>Contact Number</h4>
									<a href="tel:123-456-7890">123-456-7890</a>
									<a href="tel:123-456-7890">123-456-7890</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== CONTACT AREA END=======-->


    @include('frontend.layout.partials.ctaarea')
    @include('frontend.layout.partials.footer')

@endsection
