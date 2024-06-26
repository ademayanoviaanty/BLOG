@extends('landing-page')

@section('content')


<main class="main">

    <!-- Page Title -->
    <div class="page-title" style="background-image: url(assets/img/jsm.jpg);">
      <div class="container position-relative">
        <h1>Category</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Category</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <section id="recent-blog-posts" class="recent-blog-posts section">
                <div class="container">
                  <div class="row gy-5">
                    @foreach ($posts as $post)
                    <div class="col-xl-4 col-md-6">
                      <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="200">

                        <!-- Post Image -->
                        <div class="post-img position-relative overflow-hidden">
                          <img src="{{ Storage::url($post->thumbnail) }}" class="img-fluid post-thumbnail" alt="">
                          <!-- Displaying post date -->
                          <span class="post-date">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>

                        <!-- Post Content -->
                        <div class="post-content d-flex flex-column">
                          <!-- Post Title -->
                          <h3 class="post-title">{{ $post->title }}</h3>

                          <!-- Meta information (author and category) -->
                          <div class="meta d-flex align-items-center">
                            <div class="d-flex align-items-center">
                              <i class="bi bi-folder2"></i>
                              <span class="ps-2">{{ $post->category->name }}</span> <!-- Displaying post category -->
                            </div>
                          </div>

                          <hr>
                          <a href="/details-{{ $post->slug }}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>


                        </div> <!-- End .post-content -->

                      </div> <!-- End .post-item -->
                    </div> <!-- End .col-xl-4 or .col-md-6 -->
                    @endforeach
                  </div> <!-- End .row gy-5 -->
                </div> <!-- End .container -->
                <!-- /Recent Blog Posts Section -->
          @endsection
        </div>
      </div>
    </section><!-- /Contact Section -->

  </main>


  </main>


