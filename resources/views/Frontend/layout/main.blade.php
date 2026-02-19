<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    @if(View::hasSection('title'))
        <title>Vexon || @yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="{{ asset('storage/uploads/system_settings/' . $siteSettings->favicon) }}"
        type="image/x-icon" />

    <!--=====CSS=======-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/slick-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/mobile-menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/utility.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    @yield('style')

    <!--=====JQUERY=======-->
    <script src="{{ asset('assets/js/jquery-3-7-1.min.js') }}"></script>
</head>

<body>
    <div class="paginacontainer">
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
    </div>

    <!--=====progress END=======-->

    <!--=====PRELOADER START=======-->

    <div class="sec-preloader">
        <div class="overlay-preloader flex cac vac" id="preloader">
            <div>
                <div class="loader preloader flex vac">
                    <svg width="200" height="200">
                        <circle class="background" cx="90" cy="90" r="80" transform="rotate(-90, 100, 90)" />
                        <circle class="outer" cx="90" cy="90" r="80" transform="rotate(-90, 100, 90)" />
                    </svg>
                    <span class="circle-background"></span>
                    <span class="logo animated fade-in"> </span>
                </div>
            </div>
        </div>
    </div>

    <!--=====PRELOADER START=======-->

    <!-- search popup start -->
    <div class="search__popup">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="search__wrapper">
                        <div class="search__top d-flex justify-content-between align-items-center">
                            <div class="search__logo">
                                <a href="index.html">
                                    <img src="{{ asset('storage/uploads/system_settings/' . $siteSettings->sitelogo) }}"
                                        alt="vexon" />
                                </a>
                            </div>
                            <div class="search__close">
                                <button type="button" class="search__close-btn search-close-btn">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="search__form">
                            <form action="#">
                                <div class="search__input">
                                    <input class="search-input-field" type="text"
                                        placeholder="Type here to search..." />
                                    <span class="search-focus-border"></span>
                                    <button type="submit">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search popup end -->

    <!--=====HEADER START=======-->
    <header>
        <div class="header-area header-area1 d-none d-lg-block" id="header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-elements">
                            <div class="site-logo">
                                <a href="/">
                                    <img src="{{ asset('assets/img/logo/header-logo1.png') }}" alt="vexon" />
                                </a>
                            </div>

                            <div class="main-menu-ex main-menu-ex1">
                                <ul>
                                    <li>
                                        <a href="/">Home</a>
                                    </li>

                                    <li class="dropdown-menu-parrent">
                                        <a href="/allblogs" class="main1">Blogs</a>
                                    </li>

                                    <li class="dropdown-menu-parrent">
                                        <a href="/about" class="main1">About</a>
                                    </li>

                                    <li class="dropdown-menu-parrent">
                                        <a href="/contactus" class="main1">Contact Us</a>
                                    </li>

                                    {{-- <li class="dropdown-menu-parrent">
                                        <a href="#" class="main1">Account <i class="fa-solid fa-angle-down"></i></a>
                                        <ul>
                                            <li><a href="login">Login</a></li>
                                            <li><a href="sigup">Sign Up</a></li>
                                            <li><a href="forgot">Forgot</a></li>
                                            <li><a href="reset">Reset Password</a></li>
                                            <li><a href="verify">Verify</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>

                            <div class="header1-buttons">

                                @if(Auth::check() && Auth::user()->hasVerifiedEmail())
                                    <div class="dropdown">
                                        <img src="{{ asset(Auth::user()->profile_url) }}" alt="Profile"
                                            class="profile-img dropdown-toggle" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            style="width:40px; height:40px; border-radius:50%; cursor:pointer;">
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="/myblogs">My Blogs</a></li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>


                                @else
                                    @if(request()->is('login'))
                                        <a class="theme-btn1" href="/signup">Sign Up </a>
                                    @else
                                        <a class="theme-btn1" href="/login">Login</a>
                                    @endif

                                @endif



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--=====HEADER END=======-->

    <!--=====Mobile header start=======-->
    <div class="mobile-header mobile-header-main d-block d-lg-none">
        <div class="container-fluid">
            <div class="col-12">
                <div class="mobile-header-elements">
                    <div class="mobile-logo">
                        <a href="404-2.html"><img src="assets/img/logo/header-logo1.png" alt="vexon" /></a>
                    </div>
                    <div class="mobile-nav-icon">
                        <i class="fa-duotone fa-bars-staggered"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-sidebar d-block d-lg-none">
        <div class="logo-m">
            <a href="index.html"><img src="assets/img/logo/header-logo1.png" alt="vexon" /></a>
        </div>
        <div class="menu-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="mobile-nav">
            <ul>
                <li class="has-dropdown">
                    <a href="#">Home </a>
                </li>
                <li class="has-dropdown">
                    <a href="#">Blog</a>
                </li>
                <li class="has-dropdown">
                    <a href="#">Single Posts</a>
                </li>

                <li class="has-dropdown">
                    <a href="#">Pages</a>
                </li>

                <li class="has-dropdown has-dropdown1">
                    <a href="#" class="main">Account</a>
                </li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>

            <div class="mobile-button">
                <a class="theme-btn1" href="contact.html">Get A Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="footer-contact-area1 md:pl-0 pl-20 sm:pl-0 mt-30">
                <h3 class="text-24 leading-26 font-semibold title1 pb-10">Get in touch</h3>
                <div class="contact-box d-flex">
                    <div class="icon">
                        <img src="assets/img/icons/footer1-icon1.svg" alt="vexon" />
                    </div>
                    <div class="text">
                        <a href="mailto:contact@vexon.com">contact@vexon.com</a>
                    </div>
                </div>

                <div class="contact-box d-flex">
                    <div class="icon">
                        <img src="assets/img/icons/footer1-icon2.svg" alt="vexon" />
                    </div>
                    <div class="text">
                        <a href="#">
                            123 Innovation Drive,<br />
                            Tech City, ST 12345, USA
                        </a>
                    </div>
                </div>

                <div class="contact-box d-flex">
                    <div class="icon">
                        <img src="assets/img/icons/footer1-icon3.svg" alt="vexon" />
                    </div>
                    <div class="text">
                        <a href="tel:123-456-7890">{{$siteSettings->contactnumber}}</a>
                    </div>
                </div>
            </div>

            <div class="contact-infos">
                <h3>Our Social Network</h3>
                <ul class="social-icon">
                    <li>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--=====Mobile header end=======-->

    @yield('hero_area')

    @yield('content')



    <!--=== js === -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fontawesome.js') }}"></script>
    <script src="{{ asset('assets/js/mobile-menu.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countup.js') }}"></script>
    <script src="{{ asset('assets/js/slick-slider.js') }}"></script>
    <script src="{{ asset('assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/Splitetext.js') }}"></script>
    <script src="{{ asset('assets/js/text-animation.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/js/jaquery-ripples.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.lineProgressbar.js') }}"></script>
    <script src="{{ asset('assets/js/animation.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/pages/custom.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
        @if (session('warning'))
            toastr.warning('{{ session('warning') }}');
        @endif
    </script>

    @yield('scripts')

</body>

</html>