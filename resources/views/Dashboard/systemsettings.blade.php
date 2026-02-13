@extends('dashboard.layout.main')

@section('title', 'System Settings')

@section('breadcrumb')
    <a href="dashboard">Home</a>
    <span>/</span>
    <span>System Settings</span>
@endsection

@section('content')

{{-- system settings content goes here --}}
<div class="content-section">

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

    <form id="siteSettingForm" action="{{ route('manageSystemSetting') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="sitelogo">Site Logo</label>
            <input type="file" id="sitelogo" name="sitelogo" accept="image/*" onchange="document.getElementById('sitelogopreview').src = window.URL.createObjectURL(this.files[0]);document.getElementById('preview').style.display = 'block';" />

            <img id="sitelogopreview" src="{{ $settings->getSitelogoUrlAttribute() }}" class="m-3" alt="Current Logo" id="currentLogo" style="max-width: 200px;" />

        </div>

        <div class="form-group">
            <label for="favicon">Favicon</label>
            <input type="file" id="favicon" name="favicon" accept="image/*" onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0]);document.getElementById('preview').style.display = 'block';"/>
            <img id="faviconpreview" src="{{ $settings->getFaviconUrlAttribute() }}" class="m-3" alt="Current Favicon" id="currentFavicon" style="width: 32px; height: 32px;" />

        </div>

        <div class="form-group">
            <label for="sitename">Site Name</label>
            <input type="text" id="sitename" name="sitename" value="{{ $settings->sitename}}" />
        </div>
        <div class="form-group">
            <label for="supportemail">Support Email</label>
            <input type="email" id="supportemail" name="supportemail" value="{{ $settings->supportemail}}" />
        </div>
        <div class="form-group">
            <label for="contactnumber">Contact Number</label>
            <input type="text" id="contactnumber" name="contactnumber" value="{{ $settings->contactnumber}}" />
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address">{{ $settings->address }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary-dashboard">Save Settings</button>
    </form>
</div>

@endsection
