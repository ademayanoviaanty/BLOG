<nav id="navmenu" class="navmenu">
    <ul>
        <div class="position-relative">
            <a href="#" class="mx-2 js-search-open mb-12" style="font-size: 18px"><span
                    class="bi-search"></span></a>

            <!-- ======= Form Pencarian ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="/search" method="GET"
                    class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text"
                        placeholder="Cari"
                        name="keyword" class="form-control">
                    <button type="button" class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- Akhir Form Pencarian -->
        </div>
        <script>
            $(document).ready(function() {
                $('.mobile-nav-toggle').on('click', function() {
                    $('body').toggleClass('mobile-nav-active');
                    $('#navbar').toggleClass('navbar-mobile');
                    $(this).toggleClass('bi-list bi-x');
                });

                $('.navbar .dropdown > a').on('click', function(e) {
                    if ($('.navbar').hasClass('navbar-mobile')) {
                        e.preventDefault();
                        $(this).next('.dropdown-menu').slideToggle(300);
                    }
                });

                $('.js-search-open').on('click', function(e) {
                    e.preventDefault();
                    $('.search-form-wrap').addClass('active');
                });

                $('.js-search-close').on('click', function(e) {
                    e.preventDefault();
                    $('.search-form-wrap').removeClass('active');
                });
            });
        </script>

<li><a href="/" class="active">BLOG</a></li>
<li class="dropdown"><a href="#"><span>CATEGORY</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
    @php
        $post = \App\Models\Category::get();
    @endphp
    <ul>
        @foreach ($post as $post)
            <li><a href="category-{{ $post->slug }}">{{ $post->name }}</a></li>
        @endforeach
    </ul>
</li>
<li><a href="/contact">Contact</a></li>

    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
