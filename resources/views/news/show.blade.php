<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>DataTech - Hệ thống Quản lý Nhân sự Thông minh</title>
  <meta name="description" content="Nền tảng quản lý nhân sự hiện đại, tích hợp AI và phân tích dữ liệu cho doanh nghiệp công nghệ">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
   <link href="{{ asset('css/trangchu.css') }}" rel="stylesheet">
  
  <style>
    :root {
      --primary-color: #2563eb;
      --secondary-color: #0ea5e9;
      --accent-color: #8b5cf6;
      --dark-bg: #0f172a;
      --light-bg: #f8fafc;
      --text-dark: #1e293b;
      --text-light: #64748b;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text-dark);
      overflow-x: hidden;
      background: white;
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
    .header.scrolled { padding: 0.5rem 0; box-shadow: 0 2px 30px rgba(0, 0, 0, 0.1); }

    .logo {
      font-size: 1.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-decoration: none;
    }

    .nav-link { 
      color: var(--text-dark); 
      font-weight: 500; 
      padding: 0.5rem 1rem; 
      transition: color 0.3s ease; 
      text-decoration: none; 
    }
    .nav-link:hover { color: var(--primary-color); }

    .btn-login {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white; 
      padding: 0.7rem 2rem; 
      border-radius: 50px; 
      text-decoration: none; 
      font-weight: 600;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: inline-block;
    }
    .btn-login:hover { 
      transform: translateY(-2px); 
      box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3); 
      color: white; 
    }

    /* Breadcrumb */
    .breadcrumb-section { 
      background: var(--light-bg); 
      padding: 120px 0 30px; 
    }
    .breadcrumb-custom { 
      display: flex; 
      gap: 0.5rem; 
      align-items: center; 
      font-size: 0.9rem; 
      flex-wrap: wrap;
    }
    .breadcrumb-custom a { 
      color: var(--text-light); 
      text-decoration: none; 
      transition: color 0.3s ease; 
    }
    .breadcrumb-custom a:hover { color: var(--primary-color); }
    .breadcrumb-custom .active { 
      color: var(--text-dark); 
      font-weight: 600; 
    }

    /* Article Header */
    .article-header { 
      padding: 3rem 0; 
      max-width: 900px; 
      margin: 0 auto; 
    }
    .article-category {
      display: inline-block; 
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white; 
      padding: 0.5rem 1.5rem; 
      border-radius: 25px; 
      font-size: 0.9rem; 
      font-weight: 700;
      margin-bottom: 1.5rem; 
      text-transform: uppercase; 
      letter-spacing: 0.5px;
    }
    .article-title { 
      font-size: 3rem; 
      font-weight: 800; 
      line-height: 1.2; 
      margin-bottom: 1.5rem; 
      color: var(--text-dark); 
    }
    .article-meta { 
      display: flex; 
      flex-wrap: wrap; 
      gap: 2rem; 
      align-items: center; 
      padding: 1.5rem 0; 
      border-top: 2px solid #e2e8f0; 
      border-bottom: 2px solid #e2e8f0; 
    }
    .author-info { 
      display: flex; 
      align-items: center; 
      gap: 1rem; 
    }
    .author-avatar { 
      width: 50px; 
      height: 50px; 
      border-radius: 50%; 
      object-fit: cover; 
      border: 3px solid var(--primary-color); 
    }
    .author-details h5 { 
      font-size: 1rem; 
      font-weight: 700; 
      margin-bottom: 0.2rem; 
      color: var(--text-dark); 
    }
    .author-details p { 
      font-size: 0.85rem; 
      color: var(--text-light); 
      margin: 0; 
    }
    .meta-item { 
      display: flex; 
      align-items: center; 
      gap: 0.5rem; 
      color: var(--text-light); 
      font-size: 0.95rem; 
    }
    .meta-item i { 
      color: var(--primary-color); 
      font-size: 1.1rem; 
    }

    /* Social Share */
    .social-share { 
      display: flex; 
      gap: 0.8rem; 
    }
    .share-btn {
      width: 40px; 
      height: 40px; 
      border-radius: 50%; 
      display: flex; 
      align-items: center; 
      justify-content: center;
      border: 2px solid #e2e8f0; 
      background: white; 
      color: var(--text-dark); 
      text-decoration: none; 
      transition: all 0.3s ease;
    }
    .share-btn:hover { 
      background: var(--primary-color); 
      color: white; 
      border-color: var(--primary-color); 
      transform: translateY(-3px); 
    }

    /* Featured Image */
    .featured-image { 
      max-width: 1200px; 
      margin: 3rem auto; 
      border-radius: 20px; 
      overflow: hidden; 
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15); 
    }
    .featured-image img { 
      width: 100%; 
      height: auto; 
      display: block; 
    }

    /* Article Content */
    .article-content { 
      max-width: 800px; 
      margin: 0 auto; 
      padding: 3rem 0; 
    }
    .article-content h2 { 
      font-size: 2rem; 
      font-weight: 700; 
      margin: 3rem 0 1.5rem; 
      color: var(--text-dark); 
      position: relative; 
      padding-left: 1.5rem; 
    }
    .article-content h2::before { 
      content: ''; 
      position: absolute; 
      left: 0; 
      top: 0; 
      height: 100%; 
      width: 5px; 
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
      border-radius: 5px; 
    }
    .article-content h3 { 
      font-size: 1.5rem; 
      font-weight: 600; 
      margin: 2rem 0 1rem; 
      color: var(--text-dark); 
    }
    .article-content p { 
      font-size: 1.1rem; 
      line-height: 1.9; 
      color: #475569; 
      margin-bottom: 1.5rem; 
    }
    .article-content img { 
      max-width: 100%; 
      border-radius: 10px; 
      margin: 20px 0; 
      height: auto;
    }
    .article-content ul, .article-content ol { 
      margin: 1.5rem 0; 
      padding-left: 2rem; 
    }
    .article-content li { 
      font-size: 1.1rem; 
      line-height: 1.9; 
      color: #475569; 
      margin-bottom: 1rem; 
    }

    /* Quote Box */
    .quote-box { 
      background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%); 
      border-left: 5px solid var(--primary-color); 
      padding: 2rem 2.5rem; 
      margin: 3rem 0; 
      border-radius: 0 15px 15px 0; 
      position: relative; 
    }
    .quote-box::before { 
      content: '"'; 
      font-size: 5rem; 
      color: var(--primary-color); 
      opacity: 0.2; 
      position: absolute; 
      top: 10px; 
      left: 20px; 
      font-family: Georgia, serif; 
    }
    .quote-box p { 
      font-size: 1.3rem; 
      font-style: italic; 
      color: var(--text-dark); 
      margin: 0; 
      position: relative; 
      z-index: 1; 
    }

    /* Author Bio */
    .author-bio { 
      background: linear-gradient(135deg, var(--light-bg) 0%, #e0e7ff 100%); 
      padding: 2.5rem; 
      border-radius: 20px; 
      margin: 3rem 0; 
      display: flex; 
      gap: 2rem; 
      align-items: center; 
    }
    .author-bio-avatar { 
      width: 120px; 
      height: 120px; 
      border-radius: 50%; 
      object-fit: cover; 
      border: 5px solid white; 
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); 
      flex-shrink: 0; 
    }
    .author-bio-content h4 {
      margin-bottom: 0.5rem;
      color: var(--text-dark);
    }
    .author-bio-content p {
      margin-bottom: 0.5rem;
      color: var(--text-light);
    }
    .bio-text {
      font-size: 1rem;
      line-height: 1.6;
    }

    /* Related Posts */
    .related-posts {
      padding: 4rem 0;
      background: var(--light-bg);
    }
    .section-title {
      text-align: center;
      margin-bottom: 3rem;
    }
    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--text-dark);
    }
    .section-title p {
      color: var(--text-light);
      font-size: 1.1rem;
    }
    .related-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      cursor: pointer;
      height: 100%;
    }
    .related-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    .related-card-image {
      height: 200px;
      overflow: hidden;
    }
    .related-card-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    .related-card:hover .related-card-image img {
      transform: scale(1.1);
    }
    .related-card-content {
      padding: 1.5rem;
    }
    .related-card-category {
      display: inline-block;
      background: var(--primary-color);
      color: white;
      padding: 0.3rem 1rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .related-card-title {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--text-dark);
      line-height: 1.4;
    }
    .related-card-date {
      color: var(--text-light);
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    

    /* Progress Bar */
    .progress-bar { 
      position: fixed; 
      top: 70px; 
      left: 0; 
      height: 4px; 
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color)); 
      width: 0%; 
      z-index: 999; 
      transition: width 0.1s ease; 
    }

    /* Scroll to Top */
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
    .scroll-top:hover {
      transform: translateY(-5px);
      color: white;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
      .article-title { font-size: 2rem; }
      .social-share { 
        margin-left: 0; 
        width: 100%; 
        justify-content: flex-start; 
      }
      .author-bio { 
        flex-direction: column; 
        text-align: center; 
      }
      .article-meta {
        gap: 1rem;
      }
    }

    @media (max-width: 768px) {
      .article-header {
        padding: 2rem 0;
      }
      .article-title {
        font-size: 1.75rem;
      }
      .article-content {
        padding: 2rem 0;
      }
      .article-content h2 {
        font-size: 1.5rem;
      }
      .article-content p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="progress-bar" id="progressBar"></div>

  <header class="header" id="header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <a href="/" class="logo">DataTech</a>
        <nav class="d-none d-lg-flex align-items-center gap-4">
          <a href="/" class="nav-link">Trang chủ</a>
          <a href="{{ route('news.public') }}" class="nav-link" style="color: var(--primary-color);">Tin Tức</a>
          <a href="#" class="nav-link">Tính năng</a>
          <a href="#" class="nav-link">Liên hệ</a>
          
          @if(Auth::check())
            <a href="{{ route('dashboard') }}" class="btn-login">Dashboard</a>
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

  <section class="breadcrumb-section">
    <div class="container">
      <div class="breadcrumb-custom">
        <a href="/">Trang chủ</a>
        <i class="bi bi-chevron-right"></i>
        <a href="{{ route('news.public') }}">Tin tức</a>
        <i class="bi bi-chevron-right"></i>
        <span class="active">{{ Str::limit($post->title, 50) }}</span>
      </div>
    </div>
  </section>

  <article>
    <div class="container">
      <div class="article-header">
        <span class="article-category">{{ $post->category->name ?? 'Tin tức' }}</span>
        <h1 class="article-title">{{ $post->title }}</h1>
        
        <div class="article-meta">
          <div class="author-info">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name ?? 'Admin') }}&background=random" alt="Author" class="author-avatar">
            <div class="author-details">
              <h5>{{ $post->author->name ?? 'Ban biên tập' }}</h5>
              <p>Tác giả</p>
            </div>
          </div>
          
          <div class="meta-item">
            <i class="bi bi-calendar3"></i>
            <span>{{ $post->created_at->format('d/m/Y') }}</span>
          </div>
          
          @php
             $wordCount = str_word_count(strip_tags($post->content));
             $readingTime = ceil($wordCount / 200);
          @endphp
          <div class="meta-item">
            <i class="bi bi-clock"></i>
            <span>{{ $readingTime }} phút đọc</span>
          </div>
          
          <div class="social-share">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-btn" title="Chia sẻ Facebook">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="share-btn copy-link-btn" title="Copy link">
              <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    @if($post->thumbnail)
    <div class="container">
      <div class="featured-image">
        <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}">
      </div>
    </div>
    @endif

    <div class="container">
      <div class="article-content">
        @if($post->summary)
            <p style="font-weight: 500; font-size: 1.2rem; color: var(--text-dark);">
                {{ $post->summary }}
            </p>
        @endif

        {!! $post->content !!}
        
        <div class="author-bio">
          <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name ?? 'Admin') }}&size=120&background=random" alt="Author" class="author-bio-avatar">
          <div class="author-bio-content">
            <h4>{{ $post->author->name ?? 'Ban biên tập' }}</h4>
            <p>Tác giả tại DataTech</p>
            <p class="bio-text">Cảm ơn bạn đã theo dõi bài viết này. Hãy chia sẻ nếu bạn thấy hữu ích!</p>
          </div>
        </div>

      </div>
    </div>
  </article>

  <section class="related-posts">
  <div class="container">
    <div class="section-title">
      <h2>Bài viết khác</h2>
      <p>Khám phá thêm những tin tức mới nhất</p>
    </div>
    
    <div class="row g-4">
      @if($relatedPosts->count() > 0)
          @foreach($relatedPosts as $related)
          <div class="col-lg-4 col-md-6">
            <div class="related-card" onclick="window.location.href='{{ route('news.show', ['id' => $related->id, 'slug' => $related->slug]) }}'">
              <div class="related-card-image">
                <img src="{{ $related->thumbnail ? asset($related->thumbnail) : 'https://via.placeholder.com/600x400' }}" alt="{{ $related->title }}">
              </div>
              <div class="related-card-content">
                <div class="related-card-category">Tin tức</div> <h4 class="related-card-title">{{ Str::limit($related->title, 60) }}</h4>
                <div class="related-card-date">
                    <i class="bi bi-calendar3"></i> 
                    {{ $related->created_at->format('d/m/Y') }}
                </div>
              </div>
            </div>
          </div>
          @endforeach
      @else
          <div class="col-12 text-center">
              <p>Chưa có bài viết liên quan nào.</p>
          </div>
      @endif
    </div>
  </div>
</section>

  @include('trangchu.footer')

  <a href="#" class="scroll-top" id="scrollTop"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // --- 1. Header Scroll & Progress Bar & Show/Hide ScrollTop ---
  window.addEventListener('scroll', function() {
    const header = document.getElementById('header');
    const scrollTopBtn = document.getElementById('scrollTop');
    
    // Hiệu ứng Header và hiện nút ScrollTop khi cuộn > 100px
    if (window.scrollY > 100) {
      header.classList.add('scrolled');
      scrollTopBtn.classList.add('active');
    } else {
      header.classList.remove('scrolled');
      scrollTopBtn.classList.remove('active');
    }

    // Thanh Progress Bar đọc bài
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    const progressBar = document.getElementById('progressBar');
    if(progressBar) {
        progressBar.style.width = scrolled + '%';
    }
  });

  // --- 2. Xử lý sự kiện click vào nút Scroll To Top (FIX LỖI) ---
  const scrollTopBtn = document.getElementById('scrollTop');
  if (scrollTopBtn) {
      scrollTopBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Chặn hành vi mặc định của thẻ a
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
      });
  }

  // --- 3. Smooth scroll cho các link neo (Anchor links) khác ---
  // Loại trừ nút scrollTop ra khỏi logic này để tránh xung đột
  document.querySelectorAll('a[href^="#"]:not(#scrollTop)').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      if(targetId === '#') return; // Bỏ qua nếu chỉ là #

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
          targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // --- 4. Copy Link Button ---
  const copyLinkBtn = document.querySelector('.copy-link-btn');
  if (copyLinkBtn) {
    copyLinkBtn.addEventListener('click', function(e) {
      e.preventDefault();
      navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Đã copy link bài viết!');
      }).catch(function(err) {
        console.error('Không thể copy link:', err);
      });
    });
  }
</script>
</body>
</html>