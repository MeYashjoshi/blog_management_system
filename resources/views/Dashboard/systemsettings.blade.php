@extends('dashboard.layout.main')

@section('title', 'System Settings')

@section('content')

{{-- system settings content goes here --}}
<div class="content-section">
    @error('success')
        <div class="alert alert-warning" role="alert">
        {{ $message }}
        </div>
    @enderror

    <form action="{{ route('manageSystemSetting') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="siteLogo">Site Logo</label>
            <input type="file" id="siteLogo" name="siteLogo" accept="image/*" />
            @if($settings && $settings->sitelogo)
            <img src="{{ asset('storage/uploads/system_settings/' . $settings->sitelogo) }}" class="m-3" alt="Current Logo" id="currentLogo" style="max-width: 200px;" />
            @else
            <img src="{{ asset('assets/img/logo/header-logo1.png') }}" class="m-3" alt="Default Logo" id="currentLogo" />
            @endif
        </div>

        <div class="form-group">
            <label for="favicon">Favicon</label>
            <input type="file" id="favicon" name="favicon" accept="image/*" />
            @if($settings && $settings->favicon)
            <img src="{{ asset('storage/uploads/system_settings/' . $settings->favicon) }}" class="m-3" alt="Current Favicon" id="currentFavicon" style="width: 32px; height: 32px;" />
            @else
            <img src="{{ asset('assets/img/favicon.png') }}" class="m-3" alt="Default Favicon" id="currentFavicon" style="width: 32px; height: 32px;" />
            @endif
        </div>

        <div class="form-group">
            <label for="siteName">Site Name</label>
            <input type="text" id="siteName" name="siteName" value="{{ $settings->sitename}}" />
        </div>
        <div class="form-group">
            <label for="supportEmail">Support Email</label>
            <input type="email" id="supportEmail" name="supportEmail" value="{{ $settings->supportemail}}" />
        </div>
        <div class="form-group">
            <label for="contactNumber">Contact Number</label>
            <input type="text" id="contactNumber" name="contactNumber" value="{{ $settings->contactnumber}}" />
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address">{{ $settings->address }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>

@endsection
