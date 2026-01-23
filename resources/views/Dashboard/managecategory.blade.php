@extends('dashboard.layout.main')

@section('title', 'Manage Category')

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

@endsection

@section('content')

                <div class="content-section">

                    <form id="createCategoryForm">


                        <div class="form-row">
<div class="form-group">
                            <label for="categoryTitle">Category Title</label>
                            <input type="text" id="categoryTitle" name="title" placeholder="Technology" />
                        </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="archive">Archive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" placeholder="All Tech blog will use this Category" />
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-primary-dashboard">
                                <i class="fa-solid fa-plus"></i> Add
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
