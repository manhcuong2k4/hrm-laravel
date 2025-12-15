{{-- resources/views/trangchu/header.blade.php --}}
<header class="header" id="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="/" class="logo">DataTech</a>
            <nav class="d-none d-lg-flex align-items-center gap-4">
                <a href="#hero" class="nav-link">Trang chủ</a>
                <a href="{{ route('news.public') }}" class="nav-link">Tin Tức</a>
                <a href="#features" class="nav-link">Tính năng</a>
                <a href="#testimonials" class="nav-link">Đánh giá</a>
                <a href="#contact" class="nav-link">Liên hệ</a>
                
                @if(Auth::check())
                    {{-- Gọi button Dashboard --}}
                    @include('trangchu.button', [
                        'href' => route('dashboard'),
                        'class' => 'btn-login',
                        'content' => '<i class="bi bi-speedometer2"></i> Dashboard'
                    ])
                @else
                    {{-- Gọi button Đăng nhập --}}
                    @include('trangchu.button', [
                        'href' => route('login'),
                        'class' => 'btn-login',
                        'content' => 'Đăng nhập'
                    ])
                @endif
            </nav>
            <button class="btn btn-link d-lg-none text-dark" onclick="toggleMobileMenu()">
                <i class="bi bi-list" style="font-size: 1.5rem;"></i>
            </button>
        </div>
    </div>
</header>