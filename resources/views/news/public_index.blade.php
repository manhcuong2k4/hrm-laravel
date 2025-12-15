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
     <link href="{{ asset('css/trangchu.css') }}" rel="stylesheet">
    <style>
        /* Giữ nguyên toàn bộ CSS cũ của bạn */
        :root {
            --primary-color: #2563eb;
            --secondary-color: #0ea5e9;
            --accent-color: #8b5cf6;
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            overflow-x: hidden;
            background: var(--light-bg);
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .header.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
            text-decoration: none;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.7rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
            color: white;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
            padding: 150px 0 80px;
            position: relative;
            overflow: hidden;
            margin-top: 70px;
        }

        .page-header::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
            top: -150px;
            right: -100px;
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        .page-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .page-header p {
            font-size: 1.3rem;
            color: #cbd5e1;
            position: relative;
            z-index: 2;
        }

        /* Search & Filter Section */
        .search-filter-section {
            background: white;
            padding: 2rem 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 3rem;
            position: sticky;
            top: 60px;
            z-index: 100;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 1rem 1.5rem 1rem 3.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.2rem;
        }

        .filter-btn {
            padding: 0.8rem 2rem;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            background: white;
            color: var(--text-dark);
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0.3rem;
            cursor: pointer;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
        }

        /* Featured News Section */
        .featured-news {
            padding: 3rem 0;
        }

        .featured-card {
            position: relative;
            height: 500px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .featured-card:hover {
            transform: translateY(-10px);
        }

        .featured-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .featured-card:hover img {
            transform: scale(1.1);
        }

        .featured-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 3rem;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, transparent 100%);
            color: white;
        }

        .featured-category {
            display: inline-block;
            background: var(--accent-color);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .featured-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .featured-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* News Grid */
        .news-grid {
            padding: 3rem 0;
        }

        .news-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .news-image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-image img {
            transform: scale(1.1);
        }

        .news-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: white;
            color: var(--primary-color);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .news-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-excerpt {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .news-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .news-author {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .author-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info {
            font-size: 0.85rem;
        }

        .author-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .news-date {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .read-more {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            transition: gap 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .read-more:hover {
            gap: 0.8rem;
        }

        /* Custom Pagination Laravel Style */
        .pagination {
            justify-content: center;
            gap: 0.5rem;
        }

        .page-item .page-link {
            width: 45px;
            height: 45px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: var(--text-dark);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 2px;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-color: transparent;
        }

        .page-item.disabled .page-link {
            color: #ccc;
            pointer-events: none;
        }

        /* Footer & Other sections (Keep same) */
        .newsletter-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            padding: 5rem 0;
            margin-top: 3rem;
        }

        .newsletter-content {
            text-align: center;
            color: white;
        }

        .newsletter-form {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            gap: 1rem;
        }

        .newsletter-form input {
            flex: 1;
            padding: 1.2rem 1.5rem;
            border: none;
            border-radius: 50px;
        }

        .newsletter-form button {
            background: white;
            color: var(--primary-color);
            padding: 1.2rem 2.5rem;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
        }


        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .scroll-top.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body>
    <header class="header" id="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="/" class="logo">DataTech</a>
                <nav class="d-none d-lg-flex align-items-center gap-4">
                    <a href="/" class="nav-link">Trang chủ</a>
                    <a href="{{ route('news.public') }}" class="nav-link" style="color: var(--primary-color);">Tin
                        Tức</a>
                    <a href="#" class="nav-link">Tính năng</a>

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
                            <a href="{{ route('news.public') }}"
                                class="filter-btn {{ !request('type') ? 'active' : '' }}">Tất cả</a>
                            <a href="{{ route('news.public', ['type' => 'tech']) }}"
                                class="filter-btn {{ request('type') == 'tech' ? 'active' : '' }}">Công nghệ</a>
                            <a href="{{ route('news.public', ['type' => 'event']) }}"
                                class="filter-btn {{ request('type') == 'event' ? 'active' : '' }}">Sự kiện</a>
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
                    <img src="{{ $featured->thumbnail ? asset($featured->thumbnail) : 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=1200' }}"
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
                                    <img src="{{ $item->thumbnail ? asset($item->thumbnail) : 'https://via.placeholder.com/600x400' }}"
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
    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
                scrollTop.classList.add('active');
            } else {
                header.classList.remove('scrolled');
                scrollTop.classList.remove('active');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        function subscribeNewsletter(e) {
            e.preventDefault();
            alert('Cảm ơn bạn đã đăng ký!');
            e.target.reset();
        }
    </script>
</body>

</html>
