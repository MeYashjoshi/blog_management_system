@extends('layout.main')


@section('hero_area')	<!--===== HERO AREA START=======-->

	<div class="inner-hero bg-cover" style="background-image: url(assets/img/bg/inner-hero-bg.jpg)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-heading">
						<div class="page-prog">
							<a href="index.html">Home</a>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p>Blog</p>
							<span><i class="fa-solid fa-angle-right"></i></span>
							<p class="bold">Blog Post 01</p>
						</div>
						<h1>Blogs by Bloggers</h1>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!--===== HERO AREA END=======-->
@endsection


@section('content')

	<!--===== BLOG AREA START=======-->

	<div class="blog1 blog-formets-sec sp bg1 _relative">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="blog1-posts-area">



<div class="row align-items-center mb-60">
				<div class="col-lg-2 col-md-6">
					<div class="blog-formets">
						<a href="#"><img src="assets/img/icons/blog-formet1.svg" alt="vexon" /></a>
						<a href="#"><img src="assets/img/icons/blog-formet2.svg" alt="vexon" /></a>
						<a href="#"><img src="assets/img/icons/blog-formet3.svg" alt="vexon" /></a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="search-inputs">
						<input class="ps-4" type="search" placeholder="Search..." />
					</div>
				</div>
				<div class="col-lg-3">
					<div class="dropdown-area">
						<p>Short by</p>
						<select>
							<option value="Social Media">Social Media</option>
							<option value="Brand">Brand</option>
							<option value="Content">Content</option>
							<option value="Trending">Trending</option>
							<option value="Gen-z">Gen-z</option>
						</select>
					</div>
				</div>

				<div class="col-lg-3">
					<div class="dropdown-area">
						<p>Show</p>
						<select>
							<option value="9">9</option>
							<option value="16">16</option>
							<option value="24">24</option>
						</select>
					</div>
				</div>
</div>
            <div class="row">
            <div class="col-lg-12">
                <div class="bg-white p-4 rounded shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td class="fw-bold">The Art of Building a Strong Personal Brand on Social Media</td>
                                        <td>Yash Joshi</td>
                                        <td>

                                        <span class="badge bg-success p-2">Published</span>
                                        <span class="badge bg-danger p-2">Rejected</span>
                                        <span class="badge bg-warning text-dark p-2">Pending</span>

                                        </td>
                                        <td>25 Nov, 2000</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm rounded-pill px-3 me-2">
                                                <i class="fa-regular fa-eye"></i> View
                                            </a>

                                            <button type="button" class="btn btn-danger btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                              <i class="fa-solid fa-ban"></i> Reject
                                            </button>

                                        </td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


						<div class="space60"></div>
						<div class="row" data-aos-offset="50" data-aos="fade-up" data-aos-duration="400">
							<div class="col-12 m-auto">
								<div class="theme-pagination text-center">
									<ul>
										<li>
											<a href="#"><i class="fa-solid fa-angle-left"></i></a>
										</li>
										<li><a class="active" href="#">01</a></li>
										<li><a href="#">02</a></li>
										<li>...</li>
										<li><a href="#">12</a></li>
										<li>
											<a href="#"><i class="fa-solid fa-angle-right"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>

	<!--===== BLOG AREA END=======-->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Blog Rejected</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Selected Blog:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

@endsection



