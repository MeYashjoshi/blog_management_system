@extends('dashboard.layout.main')

@section('title', 'User Requests')

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
    <span>Users</span>
@endsection


@section('dashboard-right-button')
    @can('tag-create')
        <a href="/manageuser" class="btn-primary-dashboard"><i class="fa-solid fa-plus"></i> New User </a>
    @endcan
@endsection

@section('content')

    <div class="content-section-box">
        <div class="row g-3">

            {{-- Total Users --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Total Users Requests</h6>
                            <h3 class="fw-bold mb-0">{{ $userStatistics['total'] }}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-list"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Published Users --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Active</h6>
                            <h3 class="fw-bold mb-0">{{ $userStatistics['active'] }}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-toggle-on"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Draft Users --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Archive</h6>
                            <h3 class="fw-bold mb-0">{{ $userStatistics['pending'] }}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Inactive Users --}}
            <div class="col-md-3 col-sm-6">
                <div class="custom-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Inactive</h6>
                            <h3 class="fw-bold mb-0">{{ $userStatistics['inactive'] }}</h3>
                        </div>
                        <div class="icon-box fs-2">
                            <i class="fa-solid fa-toggle-off"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="content-section">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <form action="{{ route('page.tags') }}" method="GET">

                    <div class="row g-3 align-items-end">

                        <div class="col-md-3">
                            <label for="status" class="form-label fw-semibold">
                                Status
                            </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="0" @selected(request('status') === '0')>Pending</option>
                                <option value="2" @selected(request('status') === '2')>Inactive</option>
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

    <script>
        $(document).ready(function () {

            function get_data(page = 1) {
                console.log('Fetching data for page:');
                let status = $('#status').val() || 'all';
                let search = $('#search').val() || '';
                let itemPerPage = $('#itemPerPage').val() || 10;

                console.log(status);


                $.ajax({
                    url: "{{ route('userrequests.page') }}",
                    type: "GET",
                    data: {
                        status: status,
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

            $('#status').on('change', function () {
                get_data(1);
            });

            $('#search').on('keyup', function () {
                let search = $(this).val().trim();
                if (search.length > 3) {
                    get_data(1);
                }
            });

            $(document).on('change', '#itemPerPage', function () {
                get_data(1);
            });

        });
    </script>

@endsection