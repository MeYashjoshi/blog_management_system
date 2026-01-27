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
                        <h3 class="fw-bold mb-0">120</h3>
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
                        <h3 class="fw-bold mb-0">80</h3>
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
                        <h3 class="fw-bold mb-0">25</h3>
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
                        <h3 class="fw-bold mb-0">15</h3>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Banner</th>
                                    <th>Title</th>
                                    <th>Views</th>
                                    <th>Rejection Reason</th>
                                    <th>Uploaded Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="table-img">
                                            <img src="{{asset('assets/img/blog/blog-thumb-1.png')}}" alt="Blog Banner" />
                                        </div>
                                    </td>
                                    <td><strong>How to Master Social Media Marketing</strong></td>
                                    <td>245</td>
                                    <td>N/A</td>
                                    <td>Jan 15, 2025</td>
                                    <td>Published</td>
                                    <td>
                                        <button class="btn-secondary-dashboard btn-sm">Edit</button>
                                        <button class="btn-secondary-dashboard btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-img">
                                            <img src="{{asset('assets/img/blog/blog-thumb-2.png')}}" alt="Blog Banner" />
                                        </div>
                                    </td>
                                    <td><strong>10 Tips for Content Creation</strong></td>
                                    <td>389</td>
                                    <td>N/A</td>
                                    <td>Jan 12, 2025</td>
                                    <td>Published</td>
                                    <td>
                                        <button class="btn-secondary-dashboard btn-sm">Edit</button>
                                        <button class="btn-secondary-dashboard btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-img">
                                            <img src="{{asset('assets/img/blog/blog-thumb-3.png')}}" alt="Blog Banner" />
                                        </div>
                                    </td>
                                    <td><strong>The Future of Digital Marketing</strong></td>
                                    <td>512</td>
                                    <td>N/A</td>
                                    <td>Jan 08, 2025</td>
                                    <td>Published</td>
                                    <td>
                                        <button class="btn-secondary-dashboard btn-sm">Edit</button>
                                        <button class="btn-secondary-dashboard btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-img">
                                            <img src="{{asset('assets/img/blog/blog-thumb-4.png')}}" alt="Blog Banner" />
                                        </div>
                                    </td>
                                    <td><strong>Building Your Personal Brand</strong></td>
                                    <td>678</td>
                                    <td>N/A</td>
                                    <td>Jan 02, 2025</td>
                                    <td>Published</td>
                                    <td>
                                        <button class="btn-secondary-dashboard btn-sm">Edit</button>
                                        <button class="btn-secondary-dashboard btn-sm">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection
