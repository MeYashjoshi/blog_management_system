<div class="table-responsive">

    {{-- Top Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

        {{-- Showing Info --}}
        <div class="text-muted small">
            Showing
            <strong>{{ $res->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $res->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $res->total() }}</strong>
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
                <th>Category Name</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Status</th>
                <th width="200">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($res as $data)
            <tr>

                {{-- Name --}}
                <td>
                    <strong>{{ $data->title }}</strong>
                </td>

                {{-- Description --}}
                <td>
                    {{ $data->description ?? '-' }}
                </td>

                {{-- Date --}}
                <td>
                    {{ optional($data->created_at)->format('d M Y') ?? '-' }}
                </td>

                {{-- Status --}}
                <td>
                    @php
                    $statusMap = [
                    0 => ['Archive', 'secondary'],
                    1 => ['Active', 'success'],
                    2 => ['Inactive', 'danger'],
                    ];

                    [$label, $color] = $statusMap[$data->status] ?? ['Unknown', 'dark'];
                    @endphp

                    <span class="badge bg-{{ $color }}">
                        {{ $label }}
                    </span>
                </td>

                {{-- Actions --}}
                <td>
                    <div class="d-flex gap-2">

                        @can('category-edit')
                        <form action="{{ route('managecategories.page') }}" method="GET">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button type="submit"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </form>
                        @endcan

                        @can('category-delete')
                        @if ($data->canBeDeleted())
                        <form action="{{ route('deleteCategory') }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button type="submit"
                                class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                        @else
                        <button type="button"
                            class="btn btn-sm btn-outline-secondary"
                            title="Category is assigned to blogs."
                            disabled>
                            <i class="fa fa-lock"></i> Delete
                        </button>
                        @endif
                        @endcan

                    </div>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    No categories available.
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $res->withQueryString()->links() }}
    </div>

</div>