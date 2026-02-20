@extends('frontend.layout.main')

@section('title', 'All Blogs')

@section('hero_area')

	<!--===== HERO AREA START=======-->

	<div class="inner-hero bg-cover" style="background-image: url(assets/img/bg/inner-hero-bg.jpg)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-heading">
						<div class="page-prog">
							<a href="#">Home</a>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p>Blog</p>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p class="bold">All Blogs</p>
						</div>
						<h1>All Blogs</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== HERO AREA END=======-->

@endsection

@section('content')

	<!--===== BLOG AREA START=======-->

	<div class="blog1 blog-formets-sec sp bg1 _relative">
		<div class="container">
			<div class="row align-items-center mb-60">

				<div class="col-lg-6">
					<div class="search-inputs">
						<input class="ps-4" type="search" placeholder="Search..." />
					</div>
				</div>
				<div class="col-lg-3">
					<div class="dropdown-area">

						<select>
							<option value="all">Sort by All</option>
							<option value="recents">Recents</option>
							<option value="trending">Trending</option>
						</select>

						<select>
							<option value="all">All Categories</option>
							@foreach ($categories as $category)
								<option value="{{ $category->slug }}">{{ $category->title }}</option>
							@endforeach
						</select>
					</div>


				</div>


				<div class="col-lg-3">
					<div class="dropdown-area">
						<p>Show</p>
						<select>
							<option value="9">9</option>
							<option value="16">16</option>
							<option value="24">24</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="blog1-posts-area">
						<div class="row">
							@foreach ($blogs as $blog)

								<div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-offset="50" data-aos-duration="400"
									data-aos-delay="100">
									<div class="blog1-single-box">
										<div class="thumbnail image-anime">
											<img src="{{ $blog->featured_image_url }}" alt="vexon" />
										</div>
										<div class="heading1">
											<div class="social-area">
												<a href="#" class="social">{{ $blog->category->title }}</a>
												<a href="#" class="time"><img src="assets/img/icons/time1.svg" alt="vexon" /> 3
													min read</a>
											</div>
											<h4><a href="/blog/{{ $blog->slung }}">{{ $blog->title }}</a></h4>
											<p class="mt-16">{{ $blog->description }}</p>
											<div class="author-area">
												<div class="author">
													<div class="author-tumb">
														@if ($blog->author->profile_image)
															<img src="{{ asset('storage/' . $blog->author->profile_image) }}"
																alt="vexon" />
														@else
															<img src="{{ asset('assets/img/default-profile.png') }}" alt="vexon" />
														@endif
													</div>
													<span class="author-text">{{ $blog->author->fullname }}</span>
												</div>
												<div class="date">
													<span><img src="assets/img/icons/date1.svg" alt="vexon" />
														{{ $blog->created_at }}
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>

						<div class="space60"></div>
						<div class="row" data-aos-offset="50" data-aos="fade-up" data-aos-duration="400">
							<div class="col-12 m-auto">
								<div class="theme-pagination text-center">
									{{ $blogs->links('vendor.pagination.custom') }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== BLOG AREA END=======-->

	@include('frontend.layout.partials.ctaarea')
	@include('frontend.layout.partials.footer')

@endsection