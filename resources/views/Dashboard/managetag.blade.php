@extends('dashboard.layout.main')

@section('title', $tag?->id ? "Update Tag" : "Add Tag")

@section('style')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>

@endsection

@section('breadcrumb')
<a href="dashboard">Home</a>
<span>/</span>
<a href="{{ route('page.tags') }}">Tags</a>
<span>/</span>
<span>Manage Tag</span>
@endsection

@section('content')

<div class="content-section">

    <form id="createTagForm" action="{{ route('manageTag') }}" method="POST">
        @csrf


        <div class="form-row">
            <div class="form-group">
                <label for="categoryTitle">Tag Title</label>
                <input type="text" id="categoryTitle" name="title" placeholder="Technology" value="{{ old('title', $tag->title ?? '') }}" />
                <input type="hidden" name="id" value="{{ $tag->id ?? '' }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="1" {{ old('status', $tag->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ old('status', $tag->status ?? 1) == 2 ? 'selected' : '' }}>Inactive</option>
                    <option value="0" {{ old('status', $tag->status ?? 1) == 0 ? 'selected' : '' }}>Archive</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" placeholder="All Tech blog will use this Category" value="{{ old('description', $tag->description ?? '') }}" />
        </div>

        <div class="button-group">

            <button type="submit" class="btn-primary-dashboard">
                <i class="fa-solid fa-floppy-disk"></i> {{ isset($tag) ? 'Update' : 'Create' }}
            </button>

            <button type="button" class="btn-secondary-dashboard" onclick="window.history.back();">
                <i class="fa-solid fa-times"></i> Cancel
            </button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
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
@ends

@endsection