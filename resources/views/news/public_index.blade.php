<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tin Tức - DataTech</title>
    <meta name="description" content="Cập nhật tin tức mới nhất về công nghệ, quản lý nhân sự và hoạt động của DataTech">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/news/public_index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/trangchu/trangchu.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/images/logo.png') }}" />


</head>

<body>
    <header class="header" id="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="/" class="logo">
                    <img src="{{ asset('images/Datatech.png') }}" alt="DataTech Logo">
                </a>
                <nav class="d-none d-lg-flex align-items-center gap-4">
                    <a href="/" class="nav-link">Trang chủ</a>
                    <a href="{{ route('news.public') }}" class="nav-link" style="color: var(--primary-color);">Tin
                        Tức</a>
                    <a href="{{ route('company.show') }}" class="nav-link">Thông tin</a>

                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}" class="btn-login">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">Đăng nhập</a>
                    @endif

                </nav>
                <button class="btn btn-link d-lg-none text-dark">
                    <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                </button>
            </div>
        </div>
    </header>

    <section class="page-header">
        <div class="container">
            <div class="text-center">
                <h1>Tin Tức & Sự Kiện</h1>
                <p>Cập nhật những thông tin mới nhất về công nghệ, văn hóa doanh nghiệp và hoạt động của DataTech</p>
            </div>
        </div>
    </section>

    <section class="search-filter-section">
        <div class="container">
            <form action="{{ route('news.public') }}" method="GET">
                <div class="row align-items-center g-3">
                    <div class="col-lg-6">
                        <div class="search-box">
                            <button type="submit"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); border: none; background: none; color: #64748b; font-size: 1.2rem; cursor: pointer; z-index: 10;">
                                <i class="bi bi-search"></i>
                            </button>

                            <input type="text" name="keyword" value="{{ request('keyword') }}"
                                placeholder="Tìm kiếm tin tức, sự kiện..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-end">
                            <a href="{{ route('news.public') }}" class="filter-btn ">Tất cả</a>
                            <a href="{{ route('news.public') }}" class="filter-btn ">Công nghệ</a>
                            <a href="{{ route('news.public') }}" class="filter-btn ">Sự kiện</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @php
        $featured = $news->first();
    @endphp

    @if ($featured && $news->currentPage() == 1)
        <section class="featured-news">
            <div class="container">
                <div class="featured-card"
                    onclick="window.location.href='{{ route('news.show', ['id' => $featured->id, 'slug' => $featured->slug]) }}'">
                    <img src="{{ $featured->thumbnail ? asset($featured->thumbnail) : '' }}"
                        alt="{{ $featured->title }}">
                    <div class="featured-overlay">
                        <span class="featured-category">Mới nhất</span>
                        <h2 class="featured-title">{{ $featured->title }}</h2>
                        <div class="featured-meta">
                            <span><i class="bi bi-person-circle"></i> {{ $featured->author->name ?? 'Admin' }}</span>
                            <span><i class="bi bi-calendar3"></i> {{ $featured->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="news-grid">
        <div class="container">
            <div class="row g-4" id="newsContainer">

                @if ($news->isEmpty())
                    <div class="col-12 text-center py-5">
                        <h3>Chưa có bài viết nào.</h3>
                    </div>
                @else
                    @foreach ($news as $item)
                        @if ($loop->first && $news->currentPage() == 1)
                            @continue
                        @endif

                        <div class="col-lg-4 col-md-6">
                            <div class="news-card"
                                onclick="window.location.href='{{ route('news.show', ['id' => $item->id, 'slug' => $item->slug]) }}'">
                                <div class="news-image">
                                    <img src="{{ $item->thumbnail ? asset($item->thumbnail) : '' }}"
                                        alt="{{ $item->title }}">
                                    <span class="news-category">Tin tức</span>
                                </div>
                                <div class="news-content">
                                    <h3 class="news-title">{{ $item->title }}</h3>
                                    <div class="news-excerpt">
                                        {!! Str::limit(strip_tags($item->content), 120) !!}
                                    </div>
                                    <div class="news-footer">
                                        <div class="news-author">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->author->name ?? 'User') }}&background=random"
                                                alt="Author" class="author-avatar">
                                            <div class="author-info">
                                                <div class="author-name">{{ $item->author->name ?? 'Admin' }}</div>
                                                <div class="news-date">{{ $item->created_at->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                        <span class="read-more">
                                            Xem thêm <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <section class="pagination-section">
        {{ $news->appends(request()->query())->links() }}
    </section>

    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Đăng ký nhận tin tức</h2>
                <p>Cập nhật những thông tin mới nhất về DataTech và xu hướng công nghệ</p>
                <form class="newsletter-form" onsubmit="subscribeNewsletter(event)">
                    <input type="email" placeholder="Nhập địa chỉ email của bạn..." required>
                    <button type="submit">
                        <i class="bi bi-envelope-fill me-2"></i> Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </section>

    @include('trangchu.footer')

    <a href="#" class="scroll-top" id="scrollTop">
        <i class="bi bi-arrow-up-short"></i>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/news/index.js') }}"></script>
</body>

</html>
