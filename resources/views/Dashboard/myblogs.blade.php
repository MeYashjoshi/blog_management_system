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
        .custom-card{
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
    border: 1px solid #e2e8f0 !important;
    margin-bottom: 30px;

        }
        .content-section-box h3,.icon-box {
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
                                    <th>Rejection Reason</th>
                                    <th>Uploaded Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($blogs as $blog )
                                <tr>
                                    <td>
                                        <div class="table-img">
                                            <img src="{{$blog->getFeaturedImageUrlAttribute()}}" alt="Blog Banner" />
                                        </div>
                                    </td>
                                    <td><strong>{{$blog->title}}</strong></td>
                                    <td>N/A</td>
                                    <td>{{ $blog->published_at }}</td>
                                    {{-- <td>{{ $blog->status == 0 ? "Requested" : $blog->status == 1 ? "Published" : $blog->status == 2 ? "Inactive" : $blog->status == 3 ? "Draft" : $blog->status == 4 ? "Rejected" }}</td> --}}
                                    <td>{{ $blog->status == 0 ? "Requested" : ($blog->status == 1 ? "Published" : ($blog->status == 2 ? "Inactive" : ($blog->status == 3 ? "Draft" : ($blog->status == 4 ? "Rejected" : "Unpublished")))) }}</td>
                                    <td>
                                                <form action="{{ route('manageblog.page') }}" method="GET" class="float-start me-2" >


                                                    <input type="hidden" id="slug" name="slug"  value="{{ $blog->slung }}" />
                                                    @can('category-edit')
                                                    <button class="btn-secondary-dashboard btn-sm">Edit</button>
                                                    @endcan
                                                </form>

                                                <form action="{{ route('deleteBlog') }}" method="POST" class="float-start">
                                                    @csrf

                                                    <input type="hidden" id="id" name="id"  value="{{ $blog->id }}" />
                                                     @can('category-delete')
                                                    <button class="btn-secondary-dashboard btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
