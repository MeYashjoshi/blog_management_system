@extends('dashboard.layout.main')

@section('title', 'Manage User')

@section('breadcrumb')
    <a href="{{ route('dashboard.page') }}">Home</a>
    <span>/</span>
    <a href="{{ route('users.page') }}">Users</a>
    <span>/</span>
    <span>Manage User</span>
@endsection

@section('content')

    @php
        // Fetch stats directly to ensure functionality even if model relationships are missing
        $blogCount = \App\Models\Blog::where('author_id', $user->id)->count();
        $commentCount = \App\Models\Comment::where('user_id', $user->id)->count();
        $recentBlogs = \App\Models\Blog::where('author_id', $user->id)->latest()->take(5)->get();
    @endphp

    <div class="row">
        <div class="col-lg-4 mb-4">

            {{-- Profile Card --}}
            <div class="card shadow-sm border-0 mb-4 text-center">
                <div class="card-body p-4">
                    <div class="mb-3">
                        @if($user->profile)
                            <img src="{{ asset('storage/' . $user->profile) }}" alt="{{ $user->fullname }}"
                                class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/default-profile.png') }}" alt="{{ $user->fullname }}"
                                class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                    </div>

                    <h4 class="fw-bold mb-1">{{ $user->fullname }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary rounded-pill">{{ $user->roles()->first()->name ?? 'No Role' }}</span>

                        @php
                            $statusMap = [
                                '1' => ['Active', 'success'],
                                '2' => ['Suspended', 'danger'],
                                '0' => ['Pending', 'warning'],
                            ];
                            [$label, $color] = $statusMap[$user->status] ?? ['Unknown', 'dark'];
                         @endphp
                        <span class="badge bg-{{ $color }} rounded-pill">{{ $label }}</span>
                    </div>

                    <p class="small text-muted mb-4">
                        Member since {{ $user->created_at->format('M Y') }}
                    </p>

                    @if($user->email_verified_at)
                        <form action="{{ route('changeRole') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="input-group">
                                <select name="role" class="form-select form-select-sm" aria-label="Role Select">
                                    <option value="user" @selected($user->hasRole('user'))>User</option>
                                    <option value="editor" @selected($user->hasRole('editor'))>Editor</option>
                                    <option value="admin" @selected($user->hasRole('admin'))>Admin</option>
                                </select>
                                <button class="btn btn-outline-primary btn-sm" type="submit">Change</button>
                            </div>
                        </form>
                    @endif

                    <form action="{{ route('statusUser') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        @if($user->status == '1')
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-outline-danger w-100"
                                onclick="return confirm('Are you sure you want to suspend this user?')">
                                <i class="fa-solid fa-ban me-2"></i>Suspend User
                            </button>
                        @else
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-outline-success w-100"
                                onclick="return confirm('Are you sure you want to activate this user?')">
                                <i class="fa-solid fa-check me-2"></i>Activate User
                            </button>
                        @endif
                    </form>

                </div>
            </div>

            {{-- About / Bio --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 text-uppercase small text-muted">About</h6>
                    <p class="text-muted mb-0">
                        {{ $user->bio ?? 'No bio information available.' }}
                    </p>
                </div>
            </div>

        </div>

        <div class="col-lg-8">

            {{-- Stats --}}
            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-1 small text-uppercase fw-bold">Total Blogs</h6>
                                <h2 class="fw-bold mb-0 text-primary">{{ $blogCount }}</h2>
                            </div>
                            <div class="fs-1 text-primary opacity-25">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-1 small text-uppercase fw-bold">Comments</h6>
                                <h2 class="fw-bold mb-0 text-warning">{{ $commentCount }}</h2>
                            </div>
                            <div class="fs-1 text-warning opacity-25">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">Recent Blogs</h5>
                    @if($blogCount > 0)
                        <a href="{{ route('blogs.page', ['search' => $user->fullname]) }}" class="btn btn-sm btn-light">View
                            All</a>
                    @endif
                </div>
                <div class="card-body p-0">

                    @if($recentBlogs->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentBlogs as $blog)
                                <div class="list-group-item p-3 border-bottom">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="fa-solid fa-pen-nib text-muted"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold text-dark">{{ $blog->title }}</h6>
                                            <div class="small text-muted">
                                                <i class="fa-regular fa-clock me-1"></i> {{ $blog->created_at->diffForHumans() }}
                                                <span class="mx-2">•</span>
                                                @if($blog->status == 1) <span class="text-success">Published</span>
                                                @elseif($blog->status == 0) <span class="text-warning">Pending</span>
                                                @else <span class="text-secondary">Draft</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ route('showblog.page', $blog->id) }}"
                                                class="btn btn-sm btn-light rounded-circle">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fa-solid fa-newspaper fs-1 text-muted opacity-25 mb-3"></i>
                            <p class="text-muted">No blogs posted yet.</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

@endsection