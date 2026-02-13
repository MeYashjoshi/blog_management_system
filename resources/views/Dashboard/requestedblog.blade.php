@extends('dashboard.layout.main')

@section('title', 'Requested Blog')

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
<a href="{{ route('blogrequests.page') }}">Blog Requests</a>
<span>/</span>
<span>Requested Blog</span>

@endsection

@section('content')

<div class="content-section">

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


    <form id="createBlogForm" action="{{ route('updateBlogStatus') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $requestedBlog->id }}">
        <div class="form-group">
            <label for="blogTitle">Blog Title</label>
            <input type="text" id="blogTitle" name="title" value="{{ $requestedBlog->title }}" readonly />
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" id="category" name="category" value="{{ $requestedBlog->category->title }}"
                    readonly />
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" name="status"
                    value="{{
                        $requestedBlog->status == 0 ? 'Pending' :
                        ($requestedBlog->status == 1 ? 'Approved' :
                        ($requestedBlog->status == 2 ? 'Inactive' :
                        ($requestedBlog->status == 4 ? 'Rejected' : 'Unpublished')
                        ))
                    }}"
                    readonly />
            </div>
        </div>

        <div class="form-group">
            <label for="featuredImage">Featured Image</label>
            <img src="{{ $requestedBlog->featured_image_url }}" alt="Blog Banner" width="250" />
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="10" placeholder="" readonly>
                            {{$requestedBlog->content}}
                          </textarea>
        </div>

        {{-- <div class="form-group">
            <label for="tags">Tags (comma separated)</label>
            <input type="text" id="tags" name="tags" value="{{$requestedBlog->blog_tags}}" readonly />
        </div> --}}
        <div class="form-group">
            <label for="tags">Tags (comma separated)</label>
                   <select id="tags" name="tags[]" multiple="multiple">
                    @foreach($requestedBlog->tags_details as $tag)
                        <option value="{{ $tag->id }}" selected>{{ $tag->title }}</option>
                    @endforeach
                     </select>
        </div>



        @if ($requestedBlog->status == 4 || $requestedBlog->status == 2)

        <div class="form-group">
            <label for="tags">Rejection Reason</label>
            <input type="text" id="tags" name="tags" value="{{$requestedBlog->rejection_reason}}" readonly />
        </div>

        @endif


        <div class="button-group">

            @if ($requestedBlog->status == 0 || $requestedBlog->status == 4 || $requestedBlog->status == 2)
            @can('blog-approve')
                <button type="submit" class="btn-primary-dashboard" name="status" value="1">
                    <i class="fa-solid fa-check"></i> Approve
                </button>
            @endcan


            @endif

            @if ($requestedBlog->status == 0  || $requestedBlog->status == 2)

            @can('blog-reject')
                <button type="button" class="btn-secondary-dashboard" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="@mdo">
                <i class="fa-solid fa-times"></i>
                Reject
                </button>
            @endcan

            @endif


            @if ($requestedBlog->status == 1 || $requestedBlog->status == 0)

             <button type="button" class="btn-secondary-dashboard" data-bs-toggle="modal" data-bs-target="#unpublishModal"
                data-bs-whatever="@mdo">
                <i class="fa-solid fa-times"></i>
                Unpublish
            </button>
            @endif

            <button type="button" class="btn-secondary-dashboard" onclick="window.history.back();">
                <i class="fa-solid fa-times"></i> Cancel
            </button>
        </div>
    </form>
</div>




{{-- Modal for Rejecting Blog --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="rejectBlogForm" action="{{ route('updateBlogStatus', ['id' => $requestedBlog->id]) }}"
                method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reject Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reason for Rejection:</label>
                        <textarea class="form-control" id="rejection-reason" rows="4" name="rejection_reason"
                            required>{{ $requestedBlog->rejection_reason }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-dashboard" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-primary-dashboard" name="status" value="4">Submit
                        Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal for Unpublishing Blog --}}

<div class="modal fade" id="unpublishModal" tabindex="-1" aria-labelledby="unpublishModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="unpublishBlogForm" action="{{ route('updateBlogStatus', ['id' => $requestedBlog->id]) }}"
                method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="unpublishModalLabel">Unpublish Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reason for Unpublishing:</label>
                        <textarea class="form-control" id="unpublish_reason" rows="4" name="rejection_reason"
                            required>{{ $requestedBlog->rejection_reason }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-dashboard" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-primary-dashboard" name="status" value="5">Submit
                        Unpublishing</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>
    $(document).ready(() => {

        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: false,
                isReadOnly: true,

            })

    $('#tags').select2(
        {
            allowClear: false,
            disabled: true,
        }
    );

        });


</script>

@endsection
