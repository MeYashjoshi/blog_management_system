@extends('frontend.layout.main')

@section('title', 'Author Blogs - ' . $author->full_name)

@section('hero_area')

	<!--===== HERO AREA START=======-->

	<div class="inner-hero bg-cover" style="background-image: url({{ asset('assets/img/bg/inner-hero-bg.jpg') }})">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-heading">
						<div class="page-prog">
							<a href="{{ route('home.page') }}">Home</a>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p><a href="{{ route('allblogs.page') }}">Blog</a></p>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p class="bold">Author</p>
						</div>
						<h1>{{ $author->full_name }}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== HERO AREA END=======-->

@endsection


@section('content')


	<!--===== BLOG AREA START=======-->

	<div class="blog1 sp bg1 _relative">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="blog1-posts-area">
						<div class="row">
							@forelse ($blogs as $blog)
								<div class="col-md-6" data-aos="fade-up" data-aos-offset="50" data-aos-duration="400"
									data-aos-delay="100">
									<div class="blog1-single-box">
										<div class="thumbnail image-anime">
											<img src="{{ $blog->featured_image_url }}" alt="vexon" />
										</div>
										<div class="heading1">
											<div class="social-area">
												<a href="#" class="social">{{ $blog->category->title }}</a>
												<a href="#" class="time"><img src="{{ asset('assets/img/icons/time1.svg') }}"
														alt="vexon" /> 3 min read</a>
											</div>
											<h4><a href="{{ route('showblog.page', $blog->slung) }}">{{ $blog->title }}</a></h4>
											<p class="mt-16">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
											<div class="author-area">
												<div class="author">
													<div class="author-tumb">
														<img src="{{ $author->profile_url }}" alt="vexon" />
													</div>
													<span class="author-text">{{ $author->full_name }}</span>
												</div>
												<div class="date">
													<span><img src="{{ asset('assets/img/icons/date1.svg') }}" alt="vexon" />
														{{ $blog->published_at_formatted }} </span>
												</div>
											</div>
										</div>
									</div>
								</div>
							@empty
								<div class="col-12">
									<p>No blogs found for this author.</p>
								</div>
							@endforelse
						</div>

						<div class="space60"></div>
						<div class="row" data-aos-offset="50" data-aos="fade-up" data-aos-duration="400">
							<div class="col-12 m-auto">
								<div class="theme-pagination text-center">
									{{ $blogs->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="blog1-sidebar-area ml-30 sm:ml-0 md:ml-0 md:mt-30 sm:mt-30">

						@include('frontend.layout.sidebar.widget.searcharea')
						@include('frontend.layout.sidebar.widget.authorintro', ['author' => $author])

						@include('frontend.layout.sidebar.widget.trending')
						@include('frontend.layout.sidebar.widget.recentpost')

					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== BLOG AREA END=======-->

@endsection