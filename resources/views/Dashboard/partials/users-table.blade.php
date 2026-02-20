<div class="table-responsive">

    {{-- Top Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

        {{-- Showing Info --}}
        <div class="text-muted small">
            Showing
            <strong>{{ $users->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $users->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $users->total() }}</strong>
            results
        </div>

        {{-- Items Per Page --}}
        <div class="d-flex align-items-center gap-2">
            <label class="mb-0 small text-muted">Show</label>

            <select id="itemPerPage" class="form-select form-select-sm w-auto shadow-sm">
                @foreach([10, 25, 50, 100, 'All'] as $size)
                <option value="{{ $size }}" {{ request('itemPerPage', 10) == $size ? 'selected' : '' }}>
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
                <th>Profile</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Created Date</th>
                <th>Status</th>
                <th class="text-center" width="180">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($users as $user)
            <tr>

                {{-- Image --}}
                <td>
                    @if($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->fullname }}"
                        class="img-fluid rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                    <img src="{{ asset('assets/img/default-profile.png') }}" alt="{{ $user->fullname }}"
                        class="img-fluid rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                    @endif
                </td>

                {{-- Name --}}
                <td>
                    <strong>{{ $user->fullname }}</strong>
                </td>

                {{-- Description --}}
                <td>
                    {{ $user->email ?? '-' }}
                </td>

                {{-- Created Date --}}
                <td>
                    {{ optional($user->created_at)->format('d M Y') ?? '-' }}
                </td>

                {{-- Status --}}
                <td>
                    @php
                    $statusMap = [
                    1 => ['Approved', 'success'],
                    2 => ['Suspended', 'danger'],
                    0 => ['Pending', 'warning'],
                    ];

                    [$label, $color] = $statusMap[$user->status] ?? ['Unknown', 'dark'];
                    @endphp

                    <span class="badge bg-{{ $color }}">
                        {{ $label }}
                    </span>
                    @if ($user->email_verified_at)
                    <span class="badge bg-info" data-bs-toggle="tooltip" title="Email Verified">
                        <i class="fa fa-envelope-circle-check"></i>
                    </span>
                    @else
                    <span class="badge bg-secondary" data-bs-toggle="tooltip" title="Email Not Verified">
                        <i class="fa fa-envelope"></i>
                    </span>
                    @endif
                </td>

                {{-- Actions --}}
                <td>
                    <div class="d-flex justify-content-center gap-2">

                        <a href="{{ route('getUserDetails', ['id' => $user->id]) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye"></i> View
                        </a>

                        @if($user->status == 2)
                        <form action="{{ route('statusUser') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to make this user active?')">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <i class="fa fa-check"></i> Active
                            </button>
                        </form>
                        @endif

                        @if($user->status == 0)
                        <form action="{{ route('statusUser') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to approve this user?')">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <i class="fa fa-check"></i> Approve
                            </button>
                        </form>
                        @endif

                        @if($user->status == 1)
                        <form action="{{ route('statusUser') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to suspend this user?')">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-ban"></i> Suspend
                            </button>
                        </form>
                        @endif


                    </div>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    No users found.
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $users->withQueryString()->links() }}
    </div>

</div>