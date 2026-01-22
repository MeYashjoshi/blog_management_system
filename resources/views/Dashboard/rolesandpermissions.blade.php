@extends('dashboard.layout.main')

@section('dashboard-right-button')
     <button class="btn-primary-dashboard" data-bs-toggle="modal" data-bs-target="#permissionsModal">
                Add Role
            </button>
@endsection

@section('title', 'Roles & Permissions')


@section('content')
<div class="content-section">
    {{-- Role Card --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-semibold mb-0">Admin</h6>
                <small class="text-muted">Manage Admin roles and permissions.</small>
            </div>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permissionsModal">
                Manage Permissions
            </button>
        </div>

        <div class="card-body">
            <div class="permissions-badges">
                <span class="badge bg-primary p-2 me-1">User Management</span>
                <span class="badge bg-primary p-2 me-1">Blog Management</span>
            </div>
        </div>
    </div>

      {{-- Role Card --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-semibold mb-0">User</h6>
                <small class="text-muted">Manage User roles and permissions.</small>
            </div>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permissionsModal">
                Manage Permissions
            </button>
        </div>

        <div class="card-body">
            <div class="permissions-badges">
                <span class="badge bg-primary p-2 me-1">User Management</span>
                <span class="badge bg-primary p-2 me-1">Blog Management</span>
            </div>
        </div>
    </div>

      {{-- Role Card --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-semibold mb-0">Editor</h6>
                <small class="text-muted">Manage Editor roles and permissions.</small>
            </div>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permissionsModal">
                Manage Permissions
            </button>
        </div>

        <div class="card-body">
            <div class="permissions-badges">
                <span class="badge bg-primary p-2 me-1">User Management</span>
                <span class="badge bg-primary p-2 me-1">Blog Management</span>
            </div>
        </div>
    </div>

</div>

{{-- Permissions Modal --}}
<div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="permissionsModalLabel">Role & Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" class="form-control" value="Admin">
                </div>

                <h5 class="mb-3">Administrator Permissions</h5>

                {{-- User Management --}}
                <div class="module-permissions mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-semibold">User Management</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllUsers" checked>
                                <label class="form-check-label" for="selectAllUsers">Select All</label>
                            </div>
                        </div>

                        <div class="card-body">
                            @foreach (['View', 'Create', 'Edit', 'Delete'] as $action)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox"
                                           id="{{ strtolower($action) }}Users" checked>
                                    <label class="form-check-label" for="{{ strtolower($action) }}Users">
                                        {{ $action }} Users
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Blog Management --}}
                <div class="module-permissions mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-semibold">Blog Management</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllBlog" checked>
                                <label class="form-check-label" for="selectAllBlog">Select All</label>
                            </div>
                        </div>

                        <div class="card-body">
                            @foreach (['View', 'Create', 'Edit', 'Delete'] as $action)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox"
                                           id="{{ strtolower($action) }}Blog" checked>
                                    <label class="form-check-label" for="{{ strtolower($action) }}Blog">
                                        {{ $action }} Blog
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Save</button>
                <button class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>
document.querySelectorAll('.module-permissions').forEach(module => {
    const selectAll = module.querySelector('input[id^="selectAll"]');
    const checkboxes = module.querySelectorAll('input[type="checkbox"]:not([id^="selectAll"])');

    if (!selectAll) return;

    selectAll.addEventListener('change', () => {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            selectAll.checked = [...checkboxes].every(c => c.checked);
        });
    });
});
</script>
@endsection
