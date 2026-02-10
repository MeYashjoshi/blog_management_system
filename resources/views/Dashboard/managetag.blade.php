@extends('dashboard.layout.main')

@section('title', 'Manage Tag')

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

@endsection

@section('content')

                <div class="content-section">

                    <form id="createCategoryForm" action="{{ route('manageTag') }}" method="POST">
                        @csrf


                        <div class="form-row">
<div class="form-group">
                            <label for="categoryTitle">Tag Title</label>
                            <input type="text" id="categoryTitle" name="title" placeholder="Technology" />
                        </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="0">Archive</option>
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


