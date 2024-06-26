@extends('landing-page')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" style="background-image: url(assets/img/jsm.jpg);">
            <div class="container position-relative">
                <h1>Blog Details</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Blog Details</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <div id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article">

                                <div class="post-img">
                                    <img src="{{ Storage::url($post->thumbnail) }}" alt="" class="img-fluid">
                                </div>

                                <h2 class="title">{{ $post->title }}</h2>
                                <p>{{ $post->slug }}</p>

                                <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-folder"></i> <a
                                                href="blog-details.html">{{ $post->category->name }}</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="blog-details.html">{{ $post->created_at->format('M d, Y') }}</a></li>
                                        {{-- <li class="d-flex align-items-center"><i class="bi bi-tags"></i> @foreach ($posts as $post)<a
                                            href="blog-details.html">{{ $posts->tag }}</a>@endforeach</li> --}}


                                    </ul>
                                </div><!-- End meta top -->

                                <div class="content">
                                    <p>
                                        {{ $post->content }}
                                    </p>

                                </div><!-- End post content -->

                                {{-- <div class="meta-bottom">
                                        <i class="bi bi-folder"></i>
                                        <ul class="cats">
                                            <li><a href="#">Business</a></li>
                                        </ul>

                                        <i class="bi bi-tags"></i>
                                        <ul class="tags">
                                            <li><a href="#">Creative</a></li>
                                            <li><a href="#">Tips</a></li>
                                            <li><a href="#">Marketing</a></li>
                                        </ul>
                                    </div><!-- End meta bottom --> --}}

                            </article>

                        </div>
                    </div><!-- /Blog Details Section -->
                </div>

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container">

                        <!-- Categories Widget -->
                        @php
                            $category = \App\Models\Category::get();
                            $post = \App\Models\Post::orderBy('created_at', 'desc')->take(3)->get();
                        @endphp
                        <div class="categories-widget widget-item">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="mt-3">
                                @foreach ($category as $post)
                                    <li><a href="category-{{ $post->slug }}">{{ $post->name }}</a></li>
                                @endforeach


                            </ul>
                        </div><!--/Categories Widget -->

                        <!-- Recent Posts Widget -->
                        <div class="recent-posts-widget widget-item">

                            <h3 class="widget-title">Related Posts</h3>

                            @foreach ($related as $k)
                                <div class="post-item">
                                    <img src="{{ Storage::url($k->thumbnail) }}" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-details.html">{{ $k->title }}</a></h4>
                                        <time
                                            datetime="{{ $k->created_at->toDateString() }}">{{ $k->created_at->format('M d, Y') }}</time>
                                    </div>
                                </div><!-- End recent post item-->
                            @endforeach

                        </div><!--/Recent Posts Widget -->

                        <!-- Tags Widget -->
                        <div class="tags-widget widget-item">

                            <h3 class="widget-title">Tags</h3>
                            <ul>
                                @foreach ($taglist as $tag)

                                <li><a href="tags-{{ $tag->name }}">{{ $tag->name }}</a></li>
                                @endforeach

                            </ul>

                        </div><!--/Tags Widget -->

                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
