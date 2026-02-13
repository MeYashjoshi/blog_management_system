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
 @can('category-create')
    <a href="/managecategory" class="btn-primary-dashboard">
        <i class="fa-solid fa-plus"></i> New Category
    </a>

@endcan

@endsection

@section('breadcrumb')
    <a href="dashboard">Home</a>
    <span>/</span>
    <span>Category</span>
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
                        <h3 class="fw-bold mb-0">{{ $categoryStatistics['total'] }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $categoryStatistics['active'] }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $categoryStatistics['pending'] }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $categoryStatistics['inactive'] }}</h3>
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
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            @if ($res!=null)

                                @foreach ($res as $data )

                                        <tr>

                                            <td><strong>{{$data->title}}</strong></td>
                                            <td>{{ $data->description }}</td>
                                            <td>{{ $data->CreatedDate }}</td>
                                            <td>{{ $data->status == 0 ? "Archive" : ($data->status == 1 ? "Active" : "Inactive") }}</td>
                                            <td class="d-flex">
                                                <form action="{{ route('managecategories.page') }}" method="GET" class="me-2">
                                                    <input type="hidden" id="id" name="id"  value="{{ $data->id }}" />
                                                    @can('category-edit')
                                                    <button class="btn-primary-dashboard btn-sm"><i class="fa fa-edit"></i>Edit</button>
                                                    @endcan
                                                </form>

                                                @if ($data->canBeDeleted())
                                                    <form action="{{ route('deleteCategory') }}" method="POST">
                                                        @csrf

                                                        <input type="hidden" id="id" name="id"  value="{{ $data->id }}" />
                                                        @can('category-delete')

                                                        <button class="btn-primary-dashboard btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>

                                                     @endcan
                                                    </form>
                                                @else
                                                    <button type class="btn-primary-dashboard btn-sm" title="Category is assigned to blogs." > <i class="fa fa-lock"></i> Delete </button>

                                                @endif

                                            </td>
                                        </tr>


                                @endforeach

                                @else
                                        <tr>
                                            <td colspan="5" class="text-center">No categories avilable</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                @endif



                            </tbody>
                        </table>
                    </div>
                </div>

@endsection
