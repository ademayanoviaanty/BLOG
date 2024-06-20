<nav id="navmenu" class="navmenu">
    <ul>
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
