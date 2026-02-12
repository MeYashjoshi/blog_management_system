<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard || Vexon</title>


    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />


    <link rel="icon" href="{{'storage/uploads/system_settings/' . $siteSettings->favicon }}" type="image/x-icon" />

    @yield('style')


</head>

<body>
    <div class="dashboard-wrapper">
        @include("Dashboard.layout.sidebar")

        <div class="main-content">
            <!-- ===== NAVBAR ===== -->
            @include("Dashboard.layout.navbar")


            <div class="dashboard-content">
                <div class="breadcrumb-section">
                    <nav class="breadcrumb">
                        {{-- <a href="dashboard">Home</a>
                        <span>/</span>

                        @if(request()->is('dashboard'))
                        <span>Dashboard</span>
                        @elseif(request()->is('myblogs'))
                        <span>My Blogs</span>
                        @elseif(request()->is('blogrequests'))
                        <span>Blog Requests</span>
                        @elseif(request()->is('requestedblog'))
                         <a href="/blogrequests">Blog Requests</a>
                        <span>/</span>
                        <span>Requested Blog</span>
                        @elseif(request()->is('profile'))
                        <span>Profile</span>
                        @elseif(request()->is('manageblog'))
                        <a href="myblogs">My Blogs</a>
                        <span>/</span>
                        <span>Manage Blog</span>
                        @elseif(request()->is('categories'))
                        <span>Categories</span>
                        @elseif(request()->is('managecategory'))
                        <a href="categories">Category</a>
                         <span>/</span>
                        <span>Manage Category</span>
                         @elseif(request()->is('tags'))
                        <span>Tags</span>
                        @elseif(request()->is('managetag'))
                        <a href="tags">Tags</a>
                         <span>/</span>
                        <span>Manage Tag</span>
                        @elseif(request()->is('systemsettings'))
                        <span>System Settings</span>

                        @elseif(request()->is('rolesandpermissions'))
                        <span>Roles & Permissions</span>


                        @endif --}}

                        @yield('breadcrumb')
                    </nav>


                    @yield('dashboard-right-button')


                </div>

             @yield('content')


            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3-7-1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/custom.js') }}"></script>

     @yield('scripts')

</body>

</html>
