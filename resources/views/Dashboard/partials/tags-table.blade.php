<div class="table-responsive">

    {{-- Top Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

        {{-- Showing Info --}}
        <div class="text-muted small">
            Showing
            <strong>{{ $tags->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $tags->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $tags->total() }}</strong>
            results
        </div>

        {{-- Items Per Page --}}
        <div class="d-flex align-items-center gap-2">
            <label class="mb-0 small text-muted">Show</label>

            <select id="itemPerPage"
                class="form-select form-select-sm w-auto shadow-sm">
                @foreach([10, 25, 50, 100] as $size)
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
                <th>Tag Name</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Status</th>
                <th class="text-center" width="180">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($tags as $tag)
            <tr>

                {{-- Name --}}
                <td>
                    <strong>{{ $tag->title }}</strong>
                </td>

                {{-- Description --}}
                <td>
                    {{ $tag->description ?? '-' }}
                </td>

                {{-- Created Date --}}
                <td>
                    {{ optional($tag->created_at)->format('d M Y') ?? '-' }}
                </td>

                {{-- Status --}}
                <td>
                    @php
                    $statusMap = [
                    1 => ['Active', 'success'],
                    2 => ['Inactive', 'warning'],
                    0 => ['Archive', 'secondary'],
                    ];

                    [$label, $color] = $statusMap[$tag->status] ?? ['Unknown', 'dark'];
                    @endphp

                    <span class="badge bg-{{ $color }}">
                        {{ $label }}
                    </span>
                </td>

                {{-- Actions --}}
                <td>
                    <div class="d-flex justify-content-center gap-2">

                        @can('tag-edit')
                        <a href="{{ route('page.managetag', ['id' => $tag->id]) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        @endcan

                        @can('tag-delete')
                        @if ($tag->canBeDeleted())
                        <form action="{{ route('deleteTag') }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this tag?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $tag->id }}">
                            <button type="submit"
                                class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                        @else
                        <button type="button"
                            class="btn btn-sm btn-outline-secondary"
                            disabled
                            title="Cannot delete this tag">
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
                    No tags found.
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $tags->withQueryString()->links() }}
    </div>

</div>