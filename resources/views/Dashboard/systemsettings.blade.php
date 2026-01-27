@extends('dashboard.layout.main')

@section('title', 'System Settings')

@section('content')

{{-- system settings content goes here --}}
<div class="content-section">
    <form id="systemSettingsForm">

        <div class="form-group">
        <label for="siteLogo">Site Logo</label>
            <input type="file" id="siteLogo" name="siteLogo" />
            <img src="{{ asset('assets/img/logo/header-logo1.png') }}" class="m-3" alt="Current Logo" id="currentLogo" />
        </div>

        <div class="form-group">
            <label for="siteName">Site Name</label>
            <input type="text" id="siteName" name="siteName" value="My Blog Management System" />
        </div>
        <div class="form-group">
            <label for="supportEmail">Support Email</label>
            <input type="email" id="supportEmail" name="supportEmail" value="admin@example.com" />
        </div>
        <div class="form-group">
            <label for="contactNumber">Contact Number</label>
            <input type="text" id="contactNumber" name="contactNumber" value="+1234567890" />
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address">123 Main St, City, Country</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>

@endsection
