@extends('dashboard.layout.main')

@section('title', 'Create Blog')

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

@endsection

@section('content')

                <div class="content-section">
                    <h2 class="section-title">
                        Create New Blog
                    </h2>

                    <form id="createBlogForm">
                        <div class="form-group">
                            <label for="blogTitle">Blog Title</label>
                            <input type="text" id="blogTitle" name="title" placeholder="Enter an engaging blog title" />
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category">
                                    <option value="">Select a category</option>
                                    <option value="marketing">Digital Marketing</option>
                                    <option value="social-media">Social Media</option>
                                    <option value="content">Content Creation</option>
                                    <option value="branding">Branding</option>
                                    <option value="seo">SEO</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status">
                                    <option value="draft">Draft</option>
                                    <option value="publish">Publish</option>
                                    <option value="request" selected>Request</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="featuredImage">Featured Image</label>
                                <input type="file" id="fileInput" name="featured_image" accept="image/*" />

                            <img id="previewImage" class="preview-image" style="display: none;" />
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea id="content" name="content" rows="10" placeholder="Write your blog content here..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags (comma separated)</label>
                            <input type="text" id="tags" name="tags" placeholder="e.g., marketing, SEO, branding" />
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-primary-dashboard">
                                <i class="fa-solid fa-paper-plane"></i> Publish Blog
                            </button>
                            <button type="button" class="btn-secondary-dashboard" id="saveDraftBtn">
                                <i class="fa-solid fa-floppy-disk"></i> Save as Draft
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
