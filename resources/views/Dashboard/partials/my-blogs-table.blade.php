<div class="table-responsive">

    {{-- Top Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

        {{-- Showing Info --}}
        <div class="text-muted small">
            Showing
            <strong>{{ $blogs->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $blogs->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $blogs->total() }}</strong>
            results
        </div>

        {{-- Items Per Page --}}
        <div class="d-flex align-items-center gap-2">
            <label class="mb-0 small text-muted">Show</label>

            <select id="itemPerPage"
                class="form-select form-select-sm w-auto shadow-sm">
                @foreach([10, 25, 50, 100, 'All'] as $size)
                <option value="{{ $size }}"
                    {{ request('itemPerPage', 10) == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>

                @endforeach
            </select>

            <span class="small text-muted">entries</span>
        </div>
    </div>


    {{-- Table --}}
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Banner</th>
                <th>Title</th>
                <th>Category</th>
                <th>Rejection Reason</th>
                <th>Uploaded Date</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($blogs as $blog)
            <tr>

                {{-- Image --}}
                <td>
                    <img src="{{ $blog->featured_image_url }}"
                        alt="Blog Banner"
                        width="60"
                        class="rounded">
                </td>

                {{-- Title --}}
                <td>
                    <strong>{{ $blog->trimed_title }}</strong>
                </td>

                {{-- Category --}}
                <td>
                    {{ $blog->category->title }}
                </td>

                {{-- Rejection --}}
                <td>
                    {{ $blog->rejection_reason ?? 'N/A' }}
                </td>

                {{-- Date --}}
                <td>
                    {{ $blog->published_at_formatted }}
                </td>

                {{-- Status --}}
                <td>
                    @php
                    $statusMap = [
                    0 => ['Requested', 'warning'],
                    1 => ['Published', 'success'],
                    2 => ['Inactive', 'secondary'],
                    3 => ['Draft', 'info'],
                    4 => ['Rejected', 'danger'],
                    ];

                    [$label, $color] = $statusMap[$blog->status] ?? ['Unpublished', 'dark'];
                    @endphp

                    <span class="badge bg-{{ $color }}">
                        {{ $label }}
                    </span>
                </td>

                {{-- Actions --}}
                <td>
                    <div class="d-flex gap-2">

                        @can('category-edit')
                        <form action="{{ route('manageblog.page') }}" method="GET">
                            <input type="hidden" name="slug" value="{{ $blog->slung }}">
                            <button type="submit"
                                class="btn btn-sm btn-outline-primary">
                                Edit
                            </button>
                        </form>
                        @endcan

                        @can('category-delete')
                        <form action="{{ route('deleteBlog') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this blog?')">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blog->id }}">
                            <button type="submit"
                                class="btn btn-sm btn-outline-danger">
                                Delete
                            </button>
                        </form>
                        @endcan

                    </div>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    No blogs found.
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $blogs->withQueryString()->links() }}
    </div>

</div>