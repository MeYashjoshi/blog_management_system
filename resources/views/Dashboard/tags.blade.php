@extends('dashboard.layout.main')

@section('title', 'Tags')

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
<span>Tags</span>
@endsection


@section('dashboard-right-button')
@can('tag-create')
<a href="/managetag" class="btn-primary-dashboard"><i class="fa-solid fa-plus"></i> New Tag </a>
@endcan
@endsection

@section('content')

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

<div class="content-section-box">
    <div class="row g-3">

        {{-- Total Tags --}}
        <div class="col-md-3 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Total Tags</h6>
                        <h3 class="fw-bold mb-0">{{ $tagStatistics['total'] }}</h3>
                    </div>
                    <div class="icon-box fs-2">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Published Tags --}}
        <div class="col-md-3 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Active</h6>
                        <h3 class="fw-bold mb-0">{{ $tagStatistics['active'] }}</h3>
                    </div>
                    <div class="icon-box fs-2">
                        <i class="fa-solid fa-toggle-on"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Draft Tags --}}
        <div class="col-md-3 col-sm-6">
            <div class="custom-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Archive</h6>
                        <h3 class="fw-bold mb-0">{{ $tagStatistics['pending'] }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $tagStatistics['inactive'] }}</h3>
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
                            <option value="0" @selected(request('status')==='0' )>Archive</option>
                            <option value="1" @selected(request('status')==='1' )>Active</option>
                            <option value="2" @selected(request('status')==='2' )>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="search" class="form-label fw-semibold">
                            Search Title
                        </label>
                        <input type="text"
                            name="search"
                            id="search"
                            class="form-control"
                            placeholder="Search"
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2 d-flex gap-2">

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>

                        <a href="{{ route('blogrequests.page') }}"
                            class="btn btn-outline-secondary w-100">
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>
</div>


<div class="content-section">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Tag Name</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tags as $tag)

                <tr>
                    <td><strong>{{$tag->title}}</strong></td>
                    <td>{{$tag->description}}</td>
                    <td>{{ $tag->created_at->format('d M Y') }}</td>
                    <td>
                        @if($tag->status == 1)
                        <span class="badge bg-success">Active</span>
                        @elseif($tag->status == 2)
                        <span class="badge bg-warning">Inactive</span>
                        @else
                        <span class="badge bg-secondary">Archive</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">


                        @can('tag-edit')
                        <a href="{{ route('page.managetag', ['id' => $tag->id]) }}" class="btn-primary-dashboard btn-sm"><i class="fa fa-edit"></i>Edit </a>
                        @endcan
                        @if ($tag->canBeDeleted())
                        <form action="{{ route('deleteTag') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $tag->id }}">
                            @can('tag-delete')
                            <button class="btn-primary-dashboard btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>
                            @endcan
                        </form>
                        @else
                        <button class="btn-primary-dashboard btn-sm" disabled title="Cannot delete this tag"><i class="fa-solid fa-lock"></i>Delete</button>
                        @endif
                    </td>
                </tr>




                @endforeach

            </tbody>
        </table>

        <div class="mt-4">
            {{ $tags->links() }}
        </div>
    </div>
</div>

@endsection
