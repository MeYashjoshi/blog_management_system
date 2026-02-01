@extends('dashboard.layout.main')

@section('title', 'Requested Blog')

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

@endsection

@section('content')

                <div class="content-section">

                    <form id="createBlogForm">
                        <div class="form-group">
                            <label for="blogTitle">Blog Title</label>
                            <input type="text" id="blogTitle" name="title" value="How to Master Social Media Marketing" readonly />
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="category">Category</label>
                              <input type="text" id="category" name="category" value="Digital Marketing" readonly />
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" id="status" name="status" value="Pending Approval" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="featuredImage">Featured Image</label>
                            <img src="{{asset('assets/img/blog/blog-thumb-1.png')}}" alt="Blog Banner" />
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                          <textarea id="content" name="content" rows="10" readonly>
In today's digital age, mastering social media marketing is essential for businesses looking to expand their reach and engage with their audience. Here are some key strategies to help you excel in social media marketing:
1. Understand Your Audience: Research and analyze your target audience to create content that resonates with them.
2. Choose the Right Platforms: Focus on social media platforms where your audience is most active.
3. Create Engaging Content: Use a mix of images, videos, and text to keep your content fresh and engaging.
4. Consistency is Key: Post regularly to maintain visibility and engagement.
5. Analyze and Adjust: Use analytics tools to track performance and adjust your strategies accordingly.
                          </textarea>
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags (comma separated)</label>
                           <input type="text" id="tags" name="tags" value="social media, marketing, digital marketing" readonly />
                        </div>

                        <div class="button-group">

                            @can('blog-approve')
                                <button type="submit" class="btn-primary-dashboard">
                                    <i class="fa-solid fa-check"></i> Approve
                                </button>
                            @endcan
                            @can('blog-reject')
                                <button type="button" class="btn-secondary-dashboard" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                <i class="fa-solid fa-times"></i>
                                Reject
                                </button>
                            @endcan
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
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reason for Rejection:</label>
                        <textarea class="form-control" id="rejection-reason" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-dashboard" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn-primary-dashboard">Submit Rejection</button>
            </div>
        </div>
    </div>
</div>


@endsection


