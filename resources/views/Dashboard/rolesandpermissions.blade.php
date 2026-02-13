@extends('dashboard.layout.main')

@section('dashboard-right-button')
    <button class="btn-primary-dashboard" data-bs-toggle="modal" data-bs-target="#permissionsModal">
                Add Role
    </button>
@endsection

@section('title', 'Roles & Permissions')

@section('breadcrumb')
    <a href="dashboard">Home</a>
    <span>/</span>
    <span>Roles & Permissions</span>
@endsection

@section('content')

@if (session('success'))
    <div id="mytoast" class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-primary border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<div class="content-section">
    {{-- Role Card --}}
    @foreach ($RolesAndPermissions as $role)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-semibold mb-0">{{ $role['name'] }}</h6>
                    <small class="text-muted">Manage {{ $role['name'] }} roles and permissions.</small>
                </div>

                <div>
                    <a href="{{ route('page.managerolepermissions')}}" class="btn btn-primary-dashboard btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#permissionsModal"
                        data-type="edit"
                        data-role-id="{{$role['id'] }}">
                        Manage Role
                    </a>

                    <form action="{{ route('deleteRole') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $role['id'] }}">
                        <button type="submit" class="btn btn-primary-dashboard btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">Delete Role</button>
                    </form>
                </div>

        </div>

        <div class="card-body">
            <div class="permissions-badges">
                @foreach ($role['permissions'] as $permission)
                    <span class="badge bg-primary-dashboard p-2 me-1 my-1">{{ $permission }}</span>
                @endforeach
            </div>
        </div>
    </div>

    @endforeach

</div>

{{-- Permissions Modal --}}
<div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">

    <form method="POST" action="{{ route('manageRole') }}">
    @csrf
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="permissionsModalLabel">Role & Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="role_name" id="roleName" class="form-control">
                    <input type="hidden" name="role_id" id="roleId" class="form-control">

                </div>

                <h5 class="mb-3">Administrator Permissions</h5>


                <div id="permissionsContainer"></div>


            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary-dashboard">Submit</button>
            </div>

        </div>
    </div>
    </form>
</div>

@endsection

@section('scripts')
<script>

    // Source - https://stackoverflow.com/a/72552215
// Posted by Yogi
// Retrieved 2026-02-13, License - CC BY-SA 4.0

document.addEventListener("DOMContentLoaded", function() {

   $("#mytoast").toast();

});


function bindSelectAll() {
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
}

bindSelectAll();


$('#permissionsModal').on('show.bs.modal', function (event) {

    const button = $(event.relatedTarget);
    const type = button.data('type');
    const roleId = button.data('role-id');


    let url = '';
    let data = {};

    if (type === 'edit') {
        url = '{{ route("page.managerolepermissions") }}';
        data = { role_id: roleId };
    } else {
        url = '{{ route("getModulesAndPermissions") }}';
    }

    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        success: function(response) {

            $('#roleName').val(response.role_name ?? '');
            $('#roleId').val(response.role_id ?? '');

            buildPermissionsHTML(response.modules);
            bindSelectAll();

        }
    });
});

function buildPermissionsHTML(modules) {

    let html = '';

    $.each(modules, function(moduleName, permissions) {

        html += `
        <div class="module-permissions mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-semibold">${moduleName}</h6>
                    <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll_${moduleName}" ${ permissions.every(p => p.assigned) ? 'checked' : '' }>
                                <label class="form-check-label" for="selectAll_${moduleName}">Select All</label>
                    </div>
                </div>
                <div class="card-body">
        `;

        permissions.forEach(function(permission) {

            html += `
                <div class="form-check form-check-inline">
                    <input class="form-check-input permission-checkbox"
                           type="checkbox"
                           name="permissions[]"
                           value="${permission.id}"
                           id="perm_${permission.id}"
                           ${permission.assigned ? 'checked' : ''}>
                    <label class="form-check-label" for="perm_${permission.id}">
                        ${permission.name}
                    </label>
                </div>
            `;
        });

        html += `
                </div>
            </div>
        </div>
        `;
    });

    $('#permissionsContainer').html(html);
}





</script>
@endsection
