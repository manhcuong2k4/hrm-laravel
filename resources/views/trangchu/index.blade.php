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

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text-dark);
      overflow-x: hidden;
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

    /* Hero Section */
    :root {
    --primary-color: #3b82f6;
    --secondary-color: #8b5cf6;
  }

  /* --- CẤU TRÚC HERO CHÍNH --- */
  .hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 0; /* Xóa padding để ảnh chạm mép */
  }

  /* Hiệu ứng nền (Giữ nguyên của bạn nhưng chỉnh lại chút z-index) */
  .hero::before, .hero::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    z-index: 1; /* Nằm dưới nội dung */
  }
  .hero::before {
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.2) 0%, transparent 70%);
    top: -100px; right: 20%;
    animation: pulse 8s ease-in-out infinite;
  }
  .hero::after {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
    bottom: -100px; left: -100px;
    animation: pulse 10s ease-in-out infinite;
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.2); opacity: 0.8; }
  }

  /* --- NỘI DUNG TEXT (BÊN TRÁI) --- */
  .hero-content {
    position: relative;
    z-index: 10; /* Đè lên ảnh và nền */
    color: white;
    padding-left: 20px; /* Thêm chút khoảng cách an toàn */
  }

  .hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .hero p {
    font-size: 1.25rem;
    color: #cbd5e1;
    margin-bottom: 2.5rem;
    line-height: 1.8;
    max-width: 550px; /* Giới hạn độ rộng text để không đè vào mặt người trong ảnh */
  }

  /* --- XỬ LÝ ẢNH FULL CHIỀU CAO (BÊN PHẢI) --- */
  .hero-image-wrapper {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 55%; /* Chiếm 55% màn hình bên phải */
    z-index: 2;
  }

  .hero-img-full {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Quan trọng: Cắt ảnh vừa khung mà không méo */
    object-position: center left; /* Canh chỉnh trọng tâm ảnh */
    
    /* KỸ THUẬT BLENDING: Làm mờ cạnh trái ảnh hòa vào nền */
    -webkit-mask-image: linear-gradient(to right, transparent 0%, black 30%);
    mask-image: linear-gradient(to right, transparent 0%, black 30%);
    
    /* Hiệu ứng zoom nhẹ slow motion thay vì float */
    animation: slowZoom 20s infinite alternate;
  }

  /* Lớp phủ màu tối lên ảnh để text dễ đọc hơn nếu màn hình nhỏ */
  .hero-overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(15, 23, 42, 0.2); /* Phủ tối nhẹ 20% */
    pointer-events: none;
  }

  @keyframes slowZoom {
    from { transform: scale(1); }
    to { transform: scale(1.1); }
  }

  /* --- BUTTONS --- */
  .btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
  }
  .btn-primary-custom:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(37, 99, 235, 0.5);
    color: white;
  }

  .btn-secondary-custom {
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px); /* Hiệu ứng kính mờ */
    transition: all 0.3s ease;
  }
  .btn-secondary-custom:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
    color: white;
  }

  /* --- RESPONSIVE MOBILE --- */
  @media (max-width: 991px) {
    .hero {
        padding-top: 80px;
        padding-bottom: 50px;
        min-height: auto;
    }
    .hero h1 { font-size: 2.5rem; }
    
    /* Trên mobile: Ẩn kiểu full height, đưa về dạng ảnh thường hoặc ẩn bớt */
    .hero-image-wrapper {
        position: relative;
        width: 100%;
        height: 400px;
        margin-top: 40px;
        /* Bỏ mask trên mobile để thấy rõ ảnh */
        -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 20%);
        mask-image: linear-gradient(to bottom, transparent 0%, black 20%);
    }
    .hero-content {
        text-align: center;
        padding-left: 15px; /* Reset padding */
    }
    .d-flex.gap-3 {
        justify-content: center;
    }
    .hero p { margin: 0 auto 2rem auto; }
  }

    /* Stats Section */
    .stats-section {
      background: var(--light-bg);
      padding: 5rem 0;
    }

    .stat-card {
      background: white;
      padding: 2.5rem;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-10px);
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .stat-label {
      color: var(--text-light);
      font-size: 1.1rem;
      margin-top: 0.5rem;
    }

    /* Features Section */
    .features-section {
      padding: 6rem 0;
      background: white;
    }

    .section-title {
      text-align: center;
      margin-bottom: 4rem;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 1rem;
      color: var(--text-dark);
    }

    .section-title p {
      font-size: 1.2rem;
      color: var(--text-light);
    }

    .feature-card {
      background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
      padding: 2.5rem;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
      height: 100%;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      border-color: var(--primary-color);
    }

    .feature-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
    }

    .feature-icon i {
      font-size: 2rem;
      color: white;
    }

    .feature-card h4 {
      font-size: 1.4rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: var(--text-dark);
    }

    .feature-card p {
      color: var(--text-light);
      line-height: 1.8;
    }

    /* Benefits Section */
    .benefits-section {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      padding: 6rem 0;
    }

    .benefit-item {
      display: flex;
      align-items: start;
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .benefit-icon {
      width: 60px;
      height: 60px;
      background: white;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .benefit-icon i {
      font-size: 1.5rem;
      color: var(--primary-color);
    }

    .benefit-content h4 {
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .benefit-content p {
      color: var(--text-light);
      margin: 0;
    }

    /* Testimonials Section */
    .testimonials-section {
      padding: 6rem 0;
      background: white;
    }

    .testimonial-card {
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
      padding: 2.5rem;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      height: 100%;
    }

    .testimonial-header {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .testimonial-img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--primary-color);
    }

    .testimonial-info h4 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 0.3rem;
    }

    .testimonial-info p {
      color: var(--text-light);
      margin: 0;
    }

    .stars {
      color: #fbbf24;
      margin-bottom: 1rem;
    }

    .testimonial-text {
      color: var(--text-light);
      line-height: 1.8;
      font-style: italic;
    }

    /* Contact Section */
    .contact-section {
      padding: 6rem 0;
      background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
      color: white;
    }

    .contact-info-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      padding: 2rem;
      border-radius: 15px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }

    .contact-info-card:hover {
      background: rgba(255, 255, 255, 0.1);
      transform: translateX(10px);
    }

    .contact-info-card i {
      font-size: 2rem;
      color: var(--secondary-color);
      margin-bottom: 1rem;
    }

    .contact-info-card h4 {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .contact-info-card p {
      color: #cbd5e1;
      margin: 0;
    }

    .contact-form {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      padding: 2.5rem;
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: white;
      padding: 0.8rem 1.2rem;
      border-radius: 10px;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.15);
      border-color: var(--secondary-color);
      color: white;
      box-shadow: 0 0 0 0.2rem rgba(14, 165, 233, 0.25);
    }

    .form-control::placeholder {
      color: #94a3b8;
    }

    .btn-submit {
      background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
      color: white;
      padding: 1rem 3rem;
      border-radius: 50px;
      border: none;
      font-weight: 600;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-submit:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(14, 165, 233, 0.4);
    }

    /* Footer */
    .footer {
      background: #020617;
      color: #94a3b8;
      padding: 3rem 0 1.5rem;
      text-align: center;
    }

    .footer a {
      color: var(--secondary-color);
      text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }

      .hero p {
        font-size: 1rem;
      }

      .section-title h2 {
        font-size: 1.8rem;
      }

      .stat-number {
        font-size: 2rem;
      }
    }

    /* Scroll to top button */
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
      box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="header" id="header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <a href="#" class="logo">DataTech </a>
        <nav class="d-none d-lg-flex align-items-center gap-4">
          <a href="#hero" class="nav-link">Trang chủ</a>
          <a href="{{ route('news.public') }}" class="nav-link">Tin Tức</a>
          <a href="#features" class="nav-link">Tính năng</a>
          <a href="#testimonials" class="nav-link">Đánh giá</a>
          <a href="#contact" class="nav-link">Liên hệ</a>
          <a href="{{ route('login') }}" class="btn-login">Đăng nhập</a>
        </nav>
        <button class="btn btn-link d-lg-none text-dark" onclick="toggleMobileMenu()">
          <i class="bi bi-list" style="font-size: 1.5rem;"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="hero" class="hero">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            
            <div class="col-lg-6 hero-content">
                <h1>Quản lý Nhân sự </h1>
                <p>Nền tảng HRM tích hợp phân tích dữ liệu, tự động hóa quy trình chấm công, tính lương và tối ưu trải nghiệm nhân viên toàn diện.</p>
                
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#features" class="btn-primary-custom">Khám phá tính năng</a>
                    <a href="#about" class="btn-secondary-custom">
                        <i class="bi bi-play-circle-fill" style="font-size: 1.2rem;"></i>
                        Xem demo
                    </a>
                </div>
            </div>
            
            </div>
    </div>

    <div class="hero-image-wrapper">
        <div class="hero-overlay"></div>
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop" 
             class="hero-img-full" 
             alt="Team Working">
    </div>
</section>

  <!-- Stats Section -->
  <section class="stats-section">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-3 col-sm-6">
          <div class="stat-card">
            <div class="stat-number">500+</div>
            <div class="stat-label">Nhân viên tài năng</div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="stat-card">
            <div class="stat-number">150+</div>
            <div class="stat-label">Dự án thành công</div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="stat-card">
            <div class="stat-number">10+</div>
            <div class="stat-label">Năm kinh nghiệm</div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="stat-card">
            <div class="stat-number">98%</div>
            <div class="stat-label">Hài lòng nhân viên</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
 <section id="features" class="features-section">
    <div class="container">
        <div class="section-title">
            <h2>Tính năng cốt lõi</h2>
            <p>Hệ thống tập trung vào các chức năng quản trị quan trọng nhất cho doanh nghiệp</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <h4>Quản trị nhân sự</h4>
                    <p>Quản lý toàn diện hồ sơ nhân viên, hợp đồng lao động, sơ đồ tổ chức phòng ban và quá trình công tác.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <h4>Quản trị tin tức</h4>
                    <p>Hệ thống CMS cho phép đăng tải thông báo nội bộ, sự kiện và tin tức hoạt động của công ty nhanh chóng.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <h4>Quản trị người dùng</h4>
                    <p>Phân quyền (RBAC) chi tiết theo vai trò, quản lý tài khoản đăng nhập và kiểm soát bảo mật hệ thống.</p>
                </div>
            </div>

        </div>
    </div>
</section>

  <!-- Benefits Section -->
  <section id="benefits" class="benefits-section">
    <div class="container">
      <div class="section-title">
        <h2>Tại sao chọn DataTech?</h2>
        <p>Môi trường làm việc lý tưởng cho những tài năng công nghệ</p>
      </div>
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800" class="img-fluid rounded shadow-lg" alt="Team working">
        </div>
        <div class="col-lg-6">
          <div class="benefit-item">
            <div class="benefit-icon">
              <i class="bi bi-rocket-takeoff"></i>
            </div>
            <div class="benefit-content">
              <h4>Cơ hội thăng tiến rõ ràng</h4>
              <p>Lộ trình sự nghiệp minh bạch, đánh giá định kỳ, cơ hội quản lý và chuyên gia kỹ thuật</p>
            </div>
          </div>
          <div class="benefit-item">
            <div class="benefit-icon">
              <i class="bi bi-cash-stack"></i>
            </div>
            <div class="benefit-content">
              <h4>Đãi ngộ hấp dẫn nhất thị trường</h4>
              <p>Lương cạnh tranh top 10%, thưởng hiệu suất, ESOP, bảo hiểm sức khỏe cao cấp cho cả gia đình</p>
            </div>
          </div>
          <div class="benefit-item">
            <div class="benefit-icon">
              <i class="bi bi-globe2"></i>
            </div>
            <div class="benefit-content">
              <h4>Làm việc với chuyên gia quốc tế</h4>
              <p>Dự án global, đối tác Fortune 500, cơ hội onsite nước ngoài và học hỏi công nghệ mới nhất</p>
            </div>
          </div>
          <div class="benefit-item">
            <div class="benefit-icon">
              <i class="bi bi-laptop"></i>
            </div>
            <div class="benefit-content">
              <h4>Linh hoạt & Cân bằng</h4>
              <p>Hybrid working, flexible hours, unlimited PTO, thiết bị Apple cao cấp và văn phòng hiện đại</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials-section">
    <div class="container">
      <div class="section-title">
        <h2>Góc Nhân viên</h2>
        <p>Câu chuyện thành công từ đại gia đình DataTech</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card">
            <div class="testimonial-header">
              <img src="https://i.pravatar.cc/150?img=12" alt="Nguyễn Văn A" class="testimonial-img">
              <div class="testimonial-info">
                <h4>Nguyễn Văn An</h4>
                <p>Senior Data Engineer</p>
              </div>
            </div>
            <div class="stars">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <p class="testimonial-text">"Môi trường tại DataTech giúp tôi phát triển kỹ năng vượt bậc. Các dự án data pipeline quy mô lớn và sự hỗ trợ từ team quốc tế thật sự tuyệt vời."</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card">
            <div class="testimonial-header">
              <img src="https://i.pravatar.cc/150?img=47" alt="Trần Thị B" class="testimonial-img">
              <div class="testimonial-info">
                <h4>Trần Thị Bình</h4>
                <p>HR Business Partner</p>
              </div>
            </div>
            <div class="stars">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <p class="testimonial-text">"Văn hóa công ty luôn đặt con người lên hàng đầu. Chế độ phúc lợi, các hoạt động teambuilding và cơ hội phát triển khiến tôi gắn bó suốt 5 năm."</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card">
            <div class="testimonial-header">
              <img src="https://i.pravatar.cc/150?img=33" alt="Lê Minh C" class="testimonial-img">
              <div class="testimonial-info">
                <h4>Lê Minh Cường</h4>
                <p>Tech Lead - AI Division</p>
              </div>
            </div>
            <div class="stars">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <p class="testimonial-text">"Được làm việc với các công nghệ AI/ML tiên tiến nhất. DataTech không chỉ là nơi làm việc mà còn là ngôi nhà thứ hai của tôi."</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact-section">
    <div class="container">
      <div class="section-title text-white">
        <h2 class="text-white">Liên hệ với chúng tôi</h2>
        <p class="text-white-50">Hãy để DataTech hỗ trợ bạn xây dựng đội ngũ nhân sự xuất sắc</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="contact-info-card">
            <i class="bi bi-geo-alt"></i>
            <h4>Địa chỉ văn phòng</h4>
            <p>Tầng 14, D11 Sunrise Building,
<br>90 Trần Thái Tông, Cầu Giấy, Hà Nội</p>
          </div>
          <div class="contact-info-card">
            <i class="bi bi-envelope"></i>
            <h4>Email liên hệ</h4>
            <p>info@datatechvn.com</p>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="contact-form">
            <form id="contactForm">
              <div class="row g-3">
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Họ và tên *" required>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" placeholder="Email *" required>
                </div>
                <div class="col-md-6">
                  <input type="tel" class="form-control" placeholder="Số điện thoại *" required>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Địa chỉ *" required>
                </div>
                <div class="col-12">
                  <textarea class="form-control" rows="5" placeholder="Nội dung tin nhắn *" required></textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn-submit">
                    <i class="bi bi-send me-2"></i>
                    Gửi tin nhắn
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row g-4 mb-4">
        <div class="col-lg-4">
          <h3 class="text-white mb-3">DataTech</h3>
          <p>Giải pháp quản lý nhân sự thông minh, tích hợp AI và phân tích dữ liệu cho doanh nghiệp công nghệ.</p>
          <div class="social-links mt-3">
            <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
            <a href="#" class="me-3"><i class="bi bi-linkedin"></i></a>
            <a href="#" class="me-3"><i class="bi bi-youtube"></i></a>
            <a href="#" class="me-3"><i class="bi bi-github"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-3">
          <h5 class="text-white mb-3">Sản phẩm</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#">Tính năng</a></li>
            <li class="mb-2"><a href="#">Bảng giá</a></li>
            <li class="mb-2"><a href="#">Tích hợp</a></li>
            <li class="mb-2"><a href="#">API</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-3">
          <h5 class="text-white mb-3">Công ty</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#">Về chúng tôi</a></li>
            <li class="mb-2"><a href="#">Tuyển dụng</a></li>
            <li class="mb-2"><a href="#">Blog</a></li>
            <li class="mb-2"><a href="#">Đối tác</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-3">
          <h5 class="text-white mb-3">Hỗ trợ</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#">Trung tâm trợ giúp</a></li>
            <li class="mb-2"><a href="#">Hướng dẫn</a></li>
            <li class="mb-2"><a href="#">FAQs</a></li>
            <li class="mb-2"><a href="#">Liên hệ</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-3">
          <h5 class="text-white mb-3">Pháp lý</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#">Điều khoản</a></li>
            <li class="mb-2"><a href="#">Bảo mật</a></li>
            <li class="mb-2"><a href="#">Cookie</a></li>
            <li class="mb-2"><a href="#">GDPR</a></li>
          </ul>
        </div>
      </div>
      <hr style="border-color: rgba(255,255,255,0.1);">
      <div class="text-center pt-3">
        <p class="mb-0">© 2024 <strong>DataTech</strong>. All Rights Reserved. Designed with <i class="bi bi-heart-fill text-danger"></i> by DataTech Team</p>
      </div>
    </div>
  </footer>

  <!-- Scroll to top -->
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
      anchor.addEventListener('click', function (e) {
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

    // Contact form
    document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi trong vòng 24h.');
      this.reset();
    });

    // Mobile menu toggle
    function toggleMobileMenu() {
      alert('Mobile menu - Chức năng này cần được tích hợp với menu responsive');
    }

    // Counter animation
    function animateCounter(element, target) {
      let current = 0;
      const increment = target / 100;
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          element.textContent = target + (element.textContent.includes('%') ? '%' : '+');
          clearInterval(timer);
        } else {
          element.textContent = Math.floor(current) + (element.textContent.includes('%') ? '%' : '+');
        }
      }, 20);
    }

    // Trigger counter animation on scroll
    const observerOptions = {
      threshold: 0.5,
      rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const counters = entry.target.querySelectorAll('.stat-number');
          counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            animateCounter(counter, target);
          });
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
      observer.observe(statsSection);
    }
  </script>
</body>
</html>