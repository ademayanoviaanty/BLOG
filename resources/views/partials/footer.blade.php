<footer id="footer" class="footer">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="/landing-page" class="logo d-flex align-items-center">
                    <span class="sitename">BLOG</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, itaque possimus laudantium
                        obcaecati eveniet non at fugit quaerat molestiae optio. Repellat consequatur a error ut non sed
                        quo autem mollitia!</p>
                </div>
                @php
                    $instagram = \App\Models\Content::where('type', 'instagram')->first();
                    $twitter = \App\Models\Content::where('type', 'twitter')->first();
                    $facebook = \App\Models\Content::where('type', 'facebook')->first();
                @endphp
                <div class="social-links d-flex mt-4">
                    @if ($twitter)
                        <a href="{{ $twitter->content }}"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if ($facebook)
                        <a href="{{ $facebook->content }}"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if ($instagram)
                        <a href="{{ $instagram->content }}"><i class="bi bi-instagram"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>

            @php
                $category = \App\Models\Category::get();
                $post = \App\Models\Post::orderBy('created_at', 'desc')->take(3)->get();
            @endphp

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Categories</h4>
                <ul>
                    @foreach ($category as $post)
                        <li><a href="category-{{ $post->slug }}">{{ $post->name }}</a></li>
                    @endforeach
                </ul>
            </div>



            <div class="container copyright text-center mt-4">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Ade Maya</strong> <span>All Rights
                        Reserved</span></p>
                <div class="credits">
                    Designed by <a href="">Ade Maya</a>
                </div>
            </div>

</footer>
