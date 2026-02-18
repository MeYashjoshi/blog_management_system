<div class="table-responsive">

    {{-- Top Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

        <div class="text-muted small">
            Showing
            <strong>{{ $requestedBlogs->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $requestedBlogs->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $requestedBlogs->total() }}</strong>
            results
        </div>

        <div class="d-flex align-items-center gap-2">
            <label class="mb-0 small text-muted">Show</label>

            <select id="itemPerPage" class="form-select form-select-sm w-auto shadow-sm">
                @foreach([10,25,50,100, 'All'] as $size)
                <option value="{{ $size }}"
                    {{ request('itemPerPage',10) == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
                @endforeach
            </select>

            <span class="small text-muted">entries</span>
        </div>
    </div>


    {{-- Table --}}
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

            @forelse ($requestedBlogs as $requestedBlog)
            <tr>
                <td>
                    <div class="table-img">
                        <img src="{{ $requestedBlog->featured_image_url }}" width="60" />
                    </div>
                </td>
                <td><strong>{{ $requestedBlog->title }}</strong></td>
                <td>{{ $requestedBlog->author_name }}</td>
                <td>{{ $requestedBlog->created_at->format('d M Y') }}</td>
                <td>
                    @switch($requestedBlog->status)
                    @case(0) <span class="badge bg-warning">Pending</span> @break
                    @case(1) <span class="badge bg-success">Approved</span> @break
                    @case(2) <span class="badge bg-secondary">Inactive</span> @break
                    @case(4) <span class="badge bg-danger">Rejected</span> @break
                    @default <span class="badge bg-dark">Unpublished</span>
                    @endswitch
                </td>
                <td>
                    <form action="{{ route('requestedblog.page') }}" method="GET">
                        <input type="hidden" name="slug" value="{{ $requestedBlog->slung }}" />
                        @can('blog-approve')
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            View
                        </button>
                        @endcan
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    No blogs found.
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $requestedBlogs->links() }}
    </div>

</div>