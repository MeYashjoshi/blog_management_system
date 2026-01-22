<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard || Vexon</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/logo/title1.svg') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
   @yield('style')
    <style>


        .sidebar {
            width: 280px;
            background-color: #1e293b;
            color: white;
            padding: 30px 20px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo img {
            margin-right: 12px;
        }



        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background-color: #0f172a;
            color: white;
        }

        .sidebar-menu a.active {
            background: #6366f1;
            color: white;
        }

        .sidebar-menu i {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 16px;
        }

        .sidebar-user {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar-user-info:hover {
            background-color: #0f172a;
        }


        .main-content {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
        }

        .navbar-dashboard {
            background-color: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .page-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #6366f1 ;

        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }



        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            background: #6366f1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }

        .profile-name {
            display: flex;
            flex-direction: column;
        }

        .profile-name p {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .profile-name span {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }


        .dashboard-content {
            padding: 30px;
            flex: 1;
            overflow-y: auto;
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .breadcrumb {
            display: flex;
            gap: 8px;
            font-size: 14px;
            margin: 0;
        }

        .breadcrumb a {
            color: #6366f1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #f97316;
        }



        /* ===== CONTENT SECTIONS ===== */
        .content-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }


        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .table thead {
            background-color: #f8fafc;
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #1e293b;
            place-content: center;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .btn-primary-dashboard {
            background: #6366f1;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }



        .btn-secondary-dashboard {
            background-color: #f8fafc;
            color: #1e293b;
            border: 1px solid #e2e8f0;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-secondary-dashboard:hover {
            background-color: #e2e8f0;
            border-color: #1e293b;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }


/* Profile Page */

          .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
            padding-bottom: 30px;
        }

        .profile-avatar-lg {
            width: 120px;
            height: 120px;
            background-color: #6366f1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 48px;
            overflow: hidden;
            }

        .profile-header-info h3 {
            margin: 0 0 5px 0;
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        .profile-header-info p {
            margin: 0;
            color: #64748b;
            font-size: 16px;
        }

        .profile-header-info .user-role {
            background-color:#6366f1 ;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }

  .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            color: #1e293b;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

/* createblog */


        .editor-wrapper {
            margin-bottom: 20px;
        }

        .editor-label {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
            display: block;
        }

        .editor-toolbar {
            display: flex;
            gap: 5px;
            padding: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            flex-wrap: wrap;
        }

        .editor-btn {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            color: #6366f1;
        }

        .editor-btn:hover {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
        }

        .editor-content {
            border: 1px solid #e2e8f0;
            border-radius: 0 0 8px 8px;
            min-height: 300px;
            padding: 15px;
            background: white;
        }

        .file-upload-area:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: #f97316;
        }




    </style>
</head>

<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-logo">
            <a href="/dashboard">
                <img src="{{ asset('assets/img/logo/header-logo1.png') }}" alt="vexon" />
            </a>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/blogrequests" class="{{ request()->is('blogrequests') ? 'active' : '' }}">
                        <i class="fa-solid fa-check-circle"></i>
                        <span>Blog Requests</span>
                    </a>
                </li>
                <li>
                    <a href="/myblogs" class="{{ request()->is('myblogs') ? 'active' : '' }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>My Blogs</span>
                    </a>
                </li>

                <li>
                    <a href="/rolesandpermissions" class="{{ request()->is('rolesandpermissions') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-shield"></i>
                        <span>Roles & Permissions</span>
                    </a>
                </li>


            </ul>
        </aside>

        <div class="main-content">
            <!-- ===== NAVBAR ===== -->
            <nav class="navbar-dashboard">
                <div class="navbar-left">

                     @if(View::hasSection('title'))
                       <h1 class="page-title">@yield('title')</h1>
                    @else
                       <h1 class="page-title"></h1>
                    @endif
                </div>

                <div class="navbar-right">

                    <a href="{{ url('/') }}" target="_blank" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Site
                    </a>

                    <div class="user-profile">
                         <img src="{{ asset('assets/img/author/top-author-1.png') }}" alt="Profile" class="profile-img dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="width:40px; height:40px; border-radius:50%; cursor:pointer;">
                        <div class="profile-name">
                            <p>John Doe</p>
                            <span>Admin User</span>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                      <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                      <li><a class="dropdown-item" href="/login">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>


            <div class="dashboard-content">
                <div class="breadcrumb-section">
                    <nav class="breadcrumb">
                        <a href="dashboard">Home</a>
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
                        @elseif(request()->is('createblog'))
                        <span>Create Blog</span>
                        @elseif(request()->is('rolesandpermissions'))
                        <span>Roles & Permissions</span>


                        @endif

                    </nav>

                    @yield('dashboard-right-button')


                </div>

             @yield('content')


            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3-7-1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

     @yield('scripts')

</body>

</html>
