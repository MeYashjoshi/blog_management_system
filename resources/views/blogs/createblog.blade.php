@extends('layout.main')

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

@endsection




@section('content')
<!--===== CONTENT AREA START=======-->

    <div class="create-blog-page sp bg-cover" style="background-image: url(assets/img/bg/create-blog-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-main-heading">
                        <div class="page-prog">
                            <a href="index.html">Home</a>
                            <span><i class="fa-solid fa-angle-right"></i></span>
                            <p class="bold">Create Blog</p>
                        </div>
                        <h1>Create Blog</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="create-blog-form login-form contact-page-from ">
                        <h3>Create New Blog</h3>
                        <form action="#">

                            <div class="single-input">
                                <label>Select Category</label>
                                <select>
                                    <option value="">Select Category</option>
                                    <option value="technology">Technology</option>
                                    <option value="lifestyle">Lifestyle</option>
                                    <option value="business">Business</option>
                                </select>
                            </div>

                            <div class="single-input">
                                <label>Blog Title</label>
                                <input type="text" placeholder="Enter your blog title" />
                            </div>
                            <div class="single-input">
                                <label>Blog Content</label>
                                <textarea placeholder="Write your blog content here" name="content" id="content"></textarea>
                            </div>
                            <div class="single-input">
                                <label>Upload Image</label>
                                <input type="file" />
                            </div>
                            <div class="button mt-30">
                                <button type="submit" class="theme-btn1">Publish Blog</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== CONTENT AREA END=======-->
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
