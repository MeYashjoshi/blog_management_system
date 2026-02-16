@extends('dashboard.layout.main')

@section('title', 'Blog Requests')

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
<span>Blog Requests</span>
@endsection

@section('content')


<div class="content-section-box">
    <div class="row g-3">

        {{-- Total Blogs --}}
        <div class="col-md-4 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Total Requests</h6>
                        <h3 class="fw-bold mb-0">{{ $blogStatistics['Requested'] }}</h3>
                    </div>
                    <div class="icon-box fs-2">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Published Blogs --}}


        <div class="col-md-4 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Approved</h6>
                        <h3 class="fw-bold mb-0">{{ $blogStatistics['published'] }}</h3>
                    </div>
                    <div class="icon-box fs-2">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Draft Blogs --}}
        <div class="col-md-4 col-sm-6">
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

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Banner</th>
                    <th>Title</th>
                    <th>Uploaded By</th>
                    <th>Uploaded Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($requestedBlogs as $requestedBlog)

                <tr>
                    <td>
                        <div class="table-img">
                            <img src="{{$requestedBlog->featured_image_url}}" alt="Blog Banner" />
                        </div>
                    </td>
                    <td><strong>{{$requestedBlog->title}}</strong></td>
                    <td>{{$requestedBlog->author_name }}</td>
                    <td>{{$requestedBlog->created_at}}</td>
                    <td>{{
                        $requestedBlog->status == 0 ? 'Pending' :
                        ($requestedBlog->status == 1 ? 'Approved' :
                        ($requestedBlog->status == 2 ? 'Inactive' :
                        ($requestedBlog->status == 4 ? 'Rejected' : 'Unpublished')
                        ))
                    }}</td>
                    </td>
                    <td>
                        <form action="{{ route('requestedblog.page') }}" method="GET">

                            <input type="hidden" id="slug" name="slug" value="{{ $requestedBlog->slung }}" />
                            @can('blog-approve')
                            <button type="submit" class="btn-secondary-dashboard btn-sm">View Blog</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
