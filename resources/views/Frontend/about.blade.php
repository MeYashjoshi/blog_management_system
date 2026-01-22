@extends('frontend.layout.main')
@section('title', 'About Us')
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
                            <p class="bold">About Us</p>
                        </div>
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <!--===== ABOUT AREA START=======-->

    <div class="about-page-sec sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-page-image mb-md-3">
                        <img src="{{ asset('assets/img/blog/blog-details-image1.png') }}" alt="About Us" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-page-content">
                        <div class="heading1">
                            <h2>About Vexon Blog</h2>
                            <p class="mt-16">Vexon Blog is your go-to destination for insightful articles, expert opinions, and the latest trends in technology, lifestyle, and more. Our mission is to inform, inspire, and engage our readers through high-quality content that resonates with their interests and needs.</p>
                        </div>
                        <ul class="about-features-list mt-30">
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <p>Expert Contributors: Our team of experienced writers and industry experts bring diverse perspectives and in-depth knowledge to every article.</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <p>Comprehensive Coverage: From tech innovations to lifestyle tips, we cover a wide range of topics to cater to our varied audience.</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <p>Community Engagement: We value our readers' feedback and encourage active participation through comments, shares, and discussions.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== ABOUT AREA END=======-->
    @include('frontend.layout.partials.ctaarea')
    @include('frontend.layout.partials.footer')
@endsection
