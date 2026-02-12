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


    @foreach ($RolesAndPermissions as $role)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-semibold mb-0">{{ $role['name'] }}</h6>
                    <small class="text-muted">Manage {{ $role['name'] }} roles and permissions.</small>
                </div>

            <button id="managePermissionsBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatepermissionsModal" data-role-id="{{ $role['id'] }}">
                Manage Permissions
            </button>
        </div>

        <div class="card-body">
            <div class="permissions-badges">
                @foreach ($role['permissions'] as $permission)
                    <span class="badge bg-primary p-2 me-1 my-1">{{ $permission }}</span>
                @endforeach
            </div>
        </div>
    </div>

    @endforeach

</div>

{{-- Permissions Modal --}}
<div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">

    <form method="POST" action="{{ route('manageRole') }}">     @csrf
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

                </div>

                <h5 class="mb-3">Administrator Permissions</h5>


                @foreach ($ModulesAndPermission as $moduleName => $permissions)

                <div class="module-permissions mb-3">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-semibold">{{ $moduleName }}</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll{{ $moduleName }}" checked>
                                <label class="form-check-label" for="selectAll{{ $moduleName }}">Select All</label>
                            </div>
                        </div>

                        <div class="card-body">
                         @foreach ($permissions as $permission)
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input permission-checkbox"
                                    type="checkbox"
                                    name="permissions[]"
                                    value=""
                                    id="{{ $permission['id'] }}"
                                >
                                <label class="form-check-label" for="{{ $permission['id'] }}">
                                    {{ $permission['name'] }}
                                </label>
                            </div>
                        @endforeach

                        </div>
                    </div>
                </div>

                @endforeach



            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Save</button>
                <button class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
    </form>
</div>

{{-- Update Modal --}}
<div class="modal fade" id="updatepermissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">

    <form method="POST" action="{{ route('manageRole') }}">     @csrf
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="permissionsModalLabel">Update Role & Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="role_name" id="roleName" class="form-control">

                </div>

                <h5 class="mb-3">Administrator Permissions</h5>


                <div id="permissionsContainer"></div>


            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Save</button>
                <button class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
    </form>
</div>



@endsection

@section('scripts')
<script>

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


$('#updatepermissionsModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const roleId = button.data('role-id');

    $.ajax({
        url: '{{ route("page.managerolepermissions") }}',
        method: 'GET',
        data: { role_id: roleId },
        success: function(response) {

            console.log(response);

            let html = '';

            const roleName = Object.keys(response)[0];
            const modules = response[roleName];

            $('#roleName').val(roleName);

            $.each(modules, function(moduleName, permissions) {


                html += `
                <div class="module-permissions mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-semibold">${moduleName}</h6>
                            <div class="form-check">
                                <input class="form-check-input select-all"
                                       type="checkbox"
                                       id="selectAll${moduleName}"
                                       checked>
                                <label class="form-check-label"
                                       for="selectAll${moduleName}">
                                       Select All
                                </label>
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
                                   id="${permission.id}"
                                   checked>
                            <label class="form-check-label" for="${permission}">
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
            bindSelectAll();

        }
    });
});



</script>
@endsection
