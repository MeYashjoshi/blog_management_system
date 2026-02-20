@extends('frontend.layout.main')


@section('hero_area')

<!--===== HERO AREA START=======-->

<div class="inner-hero bg-cover" style="background-image: url({{asset('assets/img/bg/inner-hero-bg.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-heading">
                    <div class="page-prog">
                        <a href="index.html">Home</a>
                        <span><i class="fa-solid fa-angle-right"></i></span>
                        <p>Blog</p>
                        <span><i class="fa-solid fa-angle-right"></i></span>
                        <p class="bold">Blog Details</p>
                    </div>
                    <h3 class="mt-2"><b>{{ $blog->title }}</b></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!--===== HERO AREA END=======-->

@endsection


@section('content')


<!--===== BLOG DETAILS AREA START=======-->
<div class="blog-details1-all sp">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-page3-single-box">
                    <div class="heading1">

                        <h2>{{ $blog->title }}</h2>
                        <p class="mt-16">{{ $blog->description }}</p>
                    </div>

                    <div class="thumbnail image-anime _relative mt-20">
                        <img src="{{ $blog->featured_image_url }}" alt="vexon" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="details content-area mt-40">
                    <article>
                        <div class="heading1">
                            {!! $blog->content !!}
                        </div>
                    </article>


                    <div class="comments-area">
                        <div class="heading1 mt-40">
                            <h3>Blog Comments ({{ $blog->comments->count() }})</h3>
                        </div>

                        <div class="tags-social-area">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="tags">
                                        <ul>
                                            <li class="text">Tags:</li>
                                            @foreach ($blog->tags_details as $tag)
                                            <li><a href="#">{{ $tag->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="social footer-social1">
                                        <ul>
                                            <li class="text">Social:</li>
                                            <li>
                                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space30"></div>
                        <div class="comment-box">
                            <div class="top-area">
                                <div class="author-area">
                                    <div class="image">
                                        <img src="{{ asset('assets/img/blog/comment-author1.png') }}" alt="vexon" />
                                    </div>
                                    <div class="heading1 ml-20">
                                        <h4><a href="author.html">Mr. Ana Ritchie</a></h4>
                                        <p class="mt-2">8/1/2024</p>
                                    </div>
                                </div>
                                <a href="#" class="reply-btn"><i class="fa-solid fa-reply"></i> Reply</a>
                            </div>

                            <div class="heading1 mt-20">
                                <p>“This article is exactly what I needed! I've been trying to build my personal brand
                                    for a while but was getting stuck. The tips on content creation and engagement are
                                    super helpful—thanks for sharing!"</p>
                            </div>
                        </div>

                        <div class="comment-box ml-60">
                            <div class="top-area">
                                <div class="author-area">
                                    <div class="image">
                                        <img src="{{ asset('assets/img/blog/comment-author2.png') }}" alt="vexon" />
                                    </div>
                                    <div class="heading1 ml-20">
                                        <h4><a href="author.html">Matthew Kuhnemann</a></h4>
                                        <p class="mt-2">8/2/2024</p>
                                    </div>
                                </div>
                                <div class="comment-area">
                                    <a href="#" class="reply-btn p-2"><i class="fa-solid fa-reply"></i></a>
                                    <a href="#" class="reply-btn p-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#" class="reply-btn p-2" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></a>
                                </div>

                            </div>

                            <div class="heading1 mt-20">
                                <p>“I love how this breaks down the importance of consistency and authenticity. It's
                                    easy to get caught up in trends, but staying true to yourself really is key. Great
                                    read!"</p>
                            </div>
                        </div>
                    </div>

                    <div class="details-contact-area">
                        <div class="heading1">
                            <h5>Comment</h5>
                            <p class="mt-10">Comment should be a short, concise summary of your thoughts on the article.
                            </p>
                        </div>

                        <form action="#">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-input">
                                        <textarea rows="5" placeholder="Comment"></textarea>
                                    </div>
                                    <div class="button mt-30">
                                        <button class="theme-btn1" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="blog1-sidebar-area mt-40 ml-30 sm:ml-0 md:ml-0 md:mt-30 sm:mt-30">

                    @include('frontend.layout.sidebar.widget.authorintro')

                    @include('frontend.layout.sidebar.widget.recentpost')

                    @include('frontend.layout.sidebar.widget.top3categories')



                </div>
            </div>
        </div>
    </div>
</div>

<!--===== BLOG DETAILS AREA START=======-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@include('frontend.layout.partials.relatedblogs')

@include('frontend.layout.partials.ctaarea')

@include('frontend.layout.partials.footer')

@endsection
