@extends('dashboard.layout.main')

@section('title', 'Create Blog')

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
    <a href="myblogs">My Blogs</a>
    <span>/</span>
    <span>{{$blog?->id ? "Update Blog" : "Add Blog"}}</span>
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

                    <form id="blogForm" action="{{ route('manageBlog') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Blog Title <span class="fs-5 text-danger">*</span></label>
                            <input type="text" id="title" name="title" placeholder="Enter an engaging blog title" value="{{ $blog?->title }}" />
                            <input type="hidden" id="id" name="id" value="{{ $blog?->id }}"/>

                            <small id="titleError" class="text-danger d-none"> Only letters, numbers, spaces, hyphen and quotes are allowed.</small>

                            @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug<span class="fs-5 text-danger">*</span></label>
                            <input type="text" id="slug" name="slug" placeholder="Enter slug " value="{{ $blog?->slung }}" />

                            <small id="slugError" class="text-danger d-none"> Only letters, numbers, spaces and hyphen are allowed.</small>
                            @if($errors->has('slug'))
                                <div class="text-danger">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="category_id">Category <span class="fs-5 text-danger">*</span></label>
                                <select id="category_id" name="category_id">
                                <option value="">Select a category</option>

                                @foreach ($categories as $category)

                                    @php
                                        $isEdit = isset($blog);
                                        $isSelected = ($blog?->category_id ?? null) == $category->id;
                                    @endphp

                                    @if ($category->status == 1 || ($isEdit && $isSelected))
                                        <option
                                            value="{{ $category->id }}"
                                            @selected($isSelected)
                                            @disabled($category->status != 1)
                                        >
                                            {{ $category->title }}
                                            {{ $category->status != 1 ? '(Inactive)' : '' }}
                                        </option>
                                    @endif

                                @endforeach
                            </select>

                            @if($errors->has('category_id'))
                                <div class="text-danger">{{ $errors->first('category_id') }}</div>
                            @endif
                            </div>

                            <div class="form-group pt-2">
                                <label for="status">Status</label>

                                <select id="status" name="status" disabled>

                                    <option value="0" {{ ($blog?->status ?? null) == 0 ? "selected" :"" }}>Request</option>
                                    <option value="1" {{ ($blog?->status ?? null) == 1 ? "selected" :"" }}>Publish</option>
                                    <option value="2" {{ ($blog?->status ?? null) == 2 ? "selected" :"" }}>Inactive</option>
                                    <option value="3" {{ ($blog?->status ?? null) == 3 ? "selected" :"" }}>Draft</option>
                                    <option value="4" {{ ($blog?->status ?? null) == 4 ? "selected" :"" }}>Rejected</option>
                                    <option value="5" {{ ($blog?->status ?? null) == 5 ? "selected" :"" }}>Unpublished</option>

                                </select>

                            @if($errors->has('status'))
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="featured_image2">Featured Image</label>
                                <input type="file" id="featured_image" name="featured_image" accept="image/*" onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0]);document.getElementById('preview').style.display = 'block';" />


                            <img id="previewImage" class="preview-image w-25" src="{{ $blog?->featured_image_url}}" />

                            @if($errors->has('featured_image'))
                                <div class="text-danger">{{ $errors->first('featured_image') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="content">Content <span class="fs-5 text-danger">*</span></label>
                            <textarea id="content" name="content" rows="10" placeholder="Write your blog content here...">{{$blog?->content}}</textarea>
                            @if($errors->has('content'))
                                <div class="text-danger">{{ $errors->first('content') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags (comma separated)</label>
                            <input type="text" id="tags" name="tags" placeholder="e.g., marketing, SEO, branding" value="{{ $blog?->blog_tags }}" />
                            @if($errors->has('tags'))
                                <div class="text-danger">{{ $errors->first('tags') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tags">Active</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input pe-4" type="checkbox" id="status" {{ ($blog?->is_active ?? false) ? "checked" :"" }} >
                            </div>
                            @if($errors->has('is_active'))
                                <div class="text-danger">{{ $errors->first('is_active') }}</div>
                            @endif
                        </div>

                        <div class="button-group">

                            @if($blog?->status == 0 || $blog?->status == 4 || $blog?->status == 2 || $blog?->status == 3)

                            @can('blog-create')
                            <button type="submit" class="btn-primary-dashboard" name="status" value="0">
                                <i class="fa-solid fa-paper-plane"></i> {{ $blog?->id ? "Update Blog" : "Submit Blog" }}
                            </button>

                            @endcan

                             <button type="submit" class="btn-primary-dashboard" name="status" value="3">
                                    <i class="fa-solid fa-archive"></i> Save Draft
                                </button>
                            @endif

                            <button type="button" class="btn-secondary-dashboard" onclick="window.history.back();">
                                <i class="fa-solid fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>

@endsection


@section('scripts')

<script>
		$( document ).ready( () => {

			ClassicEditor
				.create( document.querySelector('#content'), {
					toolbar: [
                         'undo', 'redo', 'bold', 'italic', 'fontColor', 'fontBackgroundColor', 'link', 'numberedList', 'bulletedList', 'blockQuote'
					]
				} )
		} );
	</script>


    <script>

        // generate slug from title

        $('#title').on('input', function () {
        const regex = /^[a-zA-Z0-9\s\-'""]*$/;

        const title = $(this).val();
            const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            $('#slug').val(slug);

        if (!regex.test(title)) {
            $('#titleError').removeClass('d-none');
            $(this).addClass('is-invalid');
            } else {
                $('#titleError').addClass('d-none');
                $(this).removeClass('is-invalid');
            }
        });

        $('#slug').on('input', function () {
        const regex = /^[a-zA-Z0-9\s\-'""]*$/;

        const title = $(this).val();
            const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');

        if (!regex.test(title)) {
            $('#slugError').removeClass('d-none');
            $(this).addClass('is-invalid');
            } else {
                $('#slugError').addClass('d-none');
                $(this).removeClass('is-invalid');
            }
        });



    </script>
@endsection

