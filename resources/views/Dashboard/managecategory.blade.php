@extends('dashboard.layout.main')


@section('title',  $category?->id ? "Update Category" : "Add Category")

@section('breadcrumb')
    <a href="dashboard">Home</a>
    <span>/</span>
    <a href="categories">Category</a>
    <span>/</span>
    <span>{{$category?->id ? "Update Category" : "Add Category"}}</span>
@endsection

@section('content')

                <div class="content-section">

                    @session('success')
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endsession
                    @error('error')
                        <div class="alert alert-danger" role="alert">
                        {{ $message }}
                        </div>
                    @enderror

                    <form id="createCategoryForm" action="{{ route('manageCategory') }}" method="POST">
                        @csrf

                        <div class="form-row">
                        <div class="form-group">
                            <label for="categoryTitle">Category Title</label>
                            <input type="text" id="categoryTitle" name="title" placeholder="Technology" value="{{ $category->title ?? "" }}" />

                        @if($errors->has('title'))
                            <div class="text-danger">{{ $errors->first('title') }}</div>
                        @endif

                        </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" required>
                                    <option value="">Select</option>
                                    <option value="0"{{ $category?->status == 0 ? " selected" : "" }}>Archive</option>
                                    <option value="1"{{ $category?->status == 1 ? " selected" : "" }}>Active</option>
                                    <option value="2"{{ $category?->status == 2 ? " selected" : "" }}>Inactive</option>
                                </select>

                            </div>
                        @if($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                        @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" placeholder="All Tech blog will use this Category" value="{{ $category->description ?? "" }}" />
                            <input type="hidden" id="id" name="id"  value="{{ $category?->id }}" />
                        </div>

                        <div class="button-group">

                             @can('category-create')
                                <button type="submit" class="btn-primary-dashboard">
                                    <i class="fa-solid fa-plus"></i> {{ $category?->id ? "Update" : "Add" }}
                                </button>
                            @endcan

                             @can('category-delete')
                                <button type="button" class="btn-secondary-dashboard" onclick="window.history.back()">
                                    <i class="fa-solid fa-times"></i> Cancel
                                </button>
                            @endcan
                        </div>
                    </form>
                </div>

@endsection
