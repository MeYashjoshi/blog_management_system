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

                    <form action="{{ route('manageBlog') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Blog Title</label>
                            <input type="text" id="title" name="title" placeholder="Enter an engaging blog title" value="{{ $blog?->title }}" />
                            <input type="hidden" id="id" name="id" value="{{ $blog?->id }}"/>
                            @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select id="category_id" name="category_id">
                                    <option value="">Select a category</option>

                                    @foreach ($categories as $category )
                                        <option value="{{$category->id}}" {{ ($blog?->category_id??null) == $category->id ? "selected" :"" }} >{{$category->title}}</option>
                                    @endforeach

                                </select>
                            @if($errors->has('category'))
                                <div class="text-danger">{{ $errors->first('category') }}</div>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                
                                <select id="status" name="status" disabled>
                                    
                                    <option value="0" {{ ($blog?->status ?? null) == 0 ? "selected" :"" }}>Request</option>
                                    <option value="1" {{ ($blog?->status ?? null) == 1 ? "selected" :"" }}>Publish</option>
                                    <option value="2" {{ ($blog?->status ?? null) == 2 ? "selected" :"" }}>Inactive</option>
                                    <option value="3" {{ ($blog?->status ?? null) == 3 ? "selected" :"" }}>Draft</option>
                                    <option value="4" {{ ($blog?->status ?? null) == 4 ? "selected" :"" }}>Rejected</option>
                                   
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
                            <label for="content">Content</label>
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
                            @can('blog-create')
                                <button type="submit" class="btn-primary-dashboard" name="status" value="0">
                                    <i class="fa-solid fa-paper-plane"></i> Save and Submit
                                </button>
                            @endcan

                             <button type="submit" class="btn-primary-dashboard" name="status" value="3">
                                    <i class="fa-solid fa-archive"></i> Save Draft
                                </button>
                          
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

@endsection
