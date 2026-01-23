@extends('dashboard.layout.main')

@section('title', 'Categories')

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
 <a href="/managecategory" class="btn-primary-dashboard">
                        <i class="fa-solid fa-plus"></i> New Category
                    </a>
@endsection

@section('content')

<div class="content-section-box">
    <div class="row g-3">

        {{-- Total Categories --}}
        <div class="col-md-3 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Total Categories</h6>
                        <h3 class="fw-bold mb-0">120</h3>
                    </div>
                    <div class="icon-box fs-2">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Published Categories --}}
        <div class="col-md-3 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Active</h6>
                        <h3 class="fw-bold mb-0">80</h3>
                    </div>
                    <div class="icon-box fs-2">
                        <i class="fa-solid fa-toggle-on"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Draft Categories --}}
        <div class="col-md-3 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Archive</h6>
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
                        <h6 class="text-muted mb-1">Inactive</h6>
                        <h3 class="fw-bold mb-0">15</h3>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td><strong>Thechnology</strong></td>
                                    <td>All Tech tend will use this category</td>
                                    <td>Jan 15, 2025</td>
                                    <td>Active</td>
                                    <td>
                                        <button class="btn-secondary-dashboard btn-sm">Edit</button>
                                        <button class="btn-secondary-dashboard btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>

                                    <td><strong>Thechnology</strong></td>
                                    <td>All Tech tend will use this category</td>
                                    <td>Jan 15, 2025</td>
                                    <td>Active</td>
                                    <td>
                                        <button class="btn-secondary-dashboard btn-sm">Edit</button>
                                        <button class="btn-secondary-dashboard btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>

                                    <td><strong>Thechnology</strong></td>
                                    <td>All Tech tend will use this category</td>
                                    <td>Jan 15, 2025</td>
                                    <td>Active</td>
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
