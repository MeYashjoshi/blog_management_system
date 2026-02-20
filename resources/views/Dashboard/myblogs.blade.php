@extends('dashboard.layout.main')

@section('title', 'My Blogs')

@section('style')
    <style>
        .table-img img {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .custom-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
            border: 1px solid #e2e8f0 !important;
            margin-bottom: 30px;

        }

        .content-section-box h3,
        .icon-box {
            color: #6366f1;
        }
    </style>
@endsection

@section('breadcrumb')
    <a href="dashboard">Home</a>
    <span>/</span>
    <span>My Blogs</span>
@endsection

@section('dashboard-right-button')
    <a href="/manageblog" class="btn-primary-dashboard">
        <i class="fa-solid fa-plus"></i> New Blog
    </a>
@endsection

@section('content')

    <div class="content-section-box">
        <div class="row g-3">

            {{-- Total Blogs --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Total Blogs</h6>
                            <h3 class="fw-bold mb-0">{{ $blogStatistics['total']}}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-blog"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Published Blogs --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Published</h6>
                            <h3 class="fw-bold mb-0">{{ $blogStatistics['published'] }}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Draft Blogs --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Draft</h6>
                            <h3 class="fw-bold mb-0">{{ $blogStatistics['draft'] }}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rejected Blogs --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Rejected</h6>
                            <h3 class="fw-bold mb-0">{{ $blogStatistics['rejected'] }}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="content-section">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <form action="{{ route('myblogs.page') }}" method="GET">

                    <div class="row g-3 align-items-end">

                        <div class="col-md-3">
                            <label for="status" class="form-label fw-semibold">
                                Status
                            </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="0" @selected(request('status') == '0')>Requested</option>
                                <option value="1" @selected(request('status') == '1')>Published</option>
                                <option value="2" @selected(request('status') == '2')>Inactive</option>
                                <option value="3" @selected(request('status') == '3')>Draft</option>
                                <option value="4" @selected(request('status') == '4')>Rejected</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="category" class="form-label fw-semibold">
                                Category
                            </label>
                            <select name="category" id="category" class="form-select">
                                <option value="">All Categories</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="search" class="form-label fw-semibold">
                                Search Title
                            </label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}">
                        </div>



                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="content-section">

        <div class="table_data">


        </div>
    </div>

@endsection

@section('scripts')


    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @error('error')
        <script>
            toastr.error("{{ $message }}");
        </script>
    @enderror


    <script>
        $(document).ready(function () {



            function get_data(page = 1) {
                console.log('Fetching data for page:');
                let status = $('#status').val() || 'all';
                let category = $('#category').val() || 'all';
                let search = $('#search').val() || '';
                let itemPerPage = $('#itemPerPage').val() || 10;

                console.log(status);


                $.ajax({
                    url: "{{ route('myblogs.page') }}",
                    type: "GET",
                    data: {
                        status: status,
                        category: category,
                        search: search,
                        page: page,
                        itemPerPage: itemPerPage
                    },
                    success: function (data) {
                        $('.table_data').html(data);
                    }
                });
            }

            get_data(1);

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                let page = new URL($(this).attr('href')).searchParams.get('page');
                get_data(page);
            });

            $('#status, #category').on('change', function () {
                get_data(1);
            });

            $('#search').on('keyup', function () {
                let search = $(this).val().trim();
                if (search.length > 3 || search.length === 0) {
                    get_data(1);
                }
            });

            $(document).on('change', '#itemPerPage', function () {
                console.log("hello");
                get_data(1);
            });

        });
    </script>

@endsection