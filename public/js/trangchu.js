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