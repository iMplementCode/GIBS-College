// ===== PRELOADER =====
window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('preloader').classList.add('hidden');
    }, 1500);
});

// ===== MOBILE MENU =====
const menuToggle = document.getElementById('menuToggle');
const mobileMenu = document.getElementById('mobileMenu');

menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    mobileMenu.classList.toggle('active');
    document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
});

// Close mobile menu when clicking a link
document.querySelectorAll('.mobile-menu a').forEach(link => {
    link.addEventListener('click', (e) => {
        // Don't close if it's a dropdown trigger
        if (!link.parentElement.classList.contains('mobile-dropdown-trigger')) {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});

// Mobile Dropdown Functionality
document.querySelectorAll('.mobile-dropdown-trigger').forEach(trigger => {
    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        const submenu = trigger.querySelector('.mobile-submenu');
        trigger.classList.toggle('active');
        submenu.classList.toggle('active');
    });
});

// ===== HERO SLIDER =====
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const slideIntervalTime = 6000;
let slideInterval;

function showSlide(index) {
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));

    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
}

function moveSlide(direction) {
    showSlide(currentSlide + direction);
    resetTimer();
}

function goToSlide(index) {
    showSlide(index);
    resetTimer();
}

function startTimer() {
    slideInterval = setInterval(() => {
        moveSlide(1);
    }, slideIntervalTime);
}

function resetTimer() {
    clearInterval(slideInterval);
    startTimer();
}

startTimer();

// Pause slider on hover
const heroSlider = document.querySelector('.hero-slider');
if (heroSlider) {
    heroSlider.addEventListener('mouseenter', () => clearInterval(slideInterval));
    heroSlider.addEventListener('mouseleave', startTimer);
}

// ===== NAVBAR SCROLL EFFECT =====
const navbar = document.getElementById('navbar');

// Add scrolled class when scrolling down
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Ensure navbar is visible on page load
document.addEventListener('DOMContentLoaded', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    }
});

// ===== SCROLL TO TOP =====
const scrollTopBtn = document.getElementById('scrollTop');
window.addEventListener('scroll', () => {
    if (window.scrollY > 500) {
        scrollTopBtn.classList.add('visible');
    } else {
        scrollTopBtn.classList.remove('visible');
    }
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// ===== PROGRESS BAR =====
const progressBar = document.getElementById('progressBar');
window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY;
    const docHeight = document.body.clientHeight - window.innerHeight;
    const scrollPercent = scrollTop / docHeight * 100;
    progressBar.style.width = scrollPercent + '%';
});

// ===== FAQ ACCORDION =====
const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    
    question.addEventListener('click', () => {
        const isActive = item.classList.contains('active');
        
        // Close all FAQ items
        faqItems.forEach(faq => faq.classList.remove('active'));
        
        // Open clicked item if it wasn't active
        if (!isActive) {
            item.classList.add('active');
        }
    });
});

// ===== FORM SUBMISSION =====
const contactForm = document.getElementById('contactForm');

if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Get form data
        const formData = new FormData(contactForm);
        const data = Object.fromEntries(formData);

        // Show loading state
        const submitBtn = contactForm.querySelector('.submit-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const originalText = btnText.textContent;
        
        submitBtn.disabled = true;
        btnText.textContent = 'Sending...';

        // Simulate form submission (replace with actual API call)
        setTimeout(() => {
            // Show success message
            const successMessage = contactForm.querySelector('.form-success');
            successMessage.style.display = 'block';

            // Reset form
            contactForm.reset();

            // Reset button
            submitBtn.disabled = false;
            btnText.textContent = originalText;

            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);

            // Optional: Send WhatsApp message
            const phone = '254707730777';
            const message = `Hello GIBS College,

Name: ${data.name}
Phone: ${data.phone}
Course: ${data.course}
Message: ${data.message}`;

            const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
            
            // Uncomment to auto-open WhatsApp
            // window.open(whatsappUrl, '_blank');
            
        }, 2000);
    });
}

// ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#' || href === 'javascript:void(0)') return;

        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
            // Close mobile menu if open
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';

            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ===== ACTIVE NAV LINK ON SCROLL =====
const sections = document.querySelectorAll('section[id], div[id]');
const navLinks = document.querySelectorAll('.nav-links a, .mobile-menu > ul > li > a');

function highlightNavLink() {
    let scrollY = window.pageYOffset;

    sections.forEach(section => {
        const sectionHeight = section.offsetHeight;
        const sectionTop = section.offsetTop - 100;
        const sectionId = section.getAttribute('id');

        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${sectionId}`) {
                    link.classList.add('active');
                }
            });
        }
    });
}

window.addEventListener('scroll', highlightNavLink);

// ===== KEYBOARD SHORTCUTS =====
document.addEventListener('keydown', (e) => {
    // ESC to close mobile menu
    if (e.key === 'Escape') {
        mobileMenu.classList.remove('active');
        menuToggle.classList.remove('active');
        document.body.style.overflow = '';
    }
    // Arrow keys for slider navigation
    if (e.key === 'ArrowLeft') moveSlide(-1);
    if (e.key === 'ArrowRight') moveSlide(1);
});

// ===== SCROLL REVEAL ANIMATIONS =====
const revealOptions = {
    threshold: 0.15,
    rootMargin: '0px 0px -50px 0px'
};

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            // Optional: stop observing after reveal
            // revealObserver.unobserve(entry.target);
        }
    });
}, revealOptions);

// Observe all elements with reveal classes
document.addEventListener('DOMContentLoaded', () => {
    // Main reveal animations
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .fade-in');
    revealElements.forEach(el => revealObserver.observe(el));

    // Stagger animations for grid items
    const staggerContainers = document.querySelectorAll('.identity-grid, .why-choose-grid, .courses-grid, .curriculum-grid, .features-grid');
    
    staggerContainers.forEach(container => {
        const items = container.children;
        Array.from(items).forEach(item => {
            item.classList.add('stagger-item');
            revealObserver.observe(item);
        });
    });

    // Section headers
    const sectionHeaders = document.querySelectorAll('.section-header');
    sectionHeaders.forEach(header => {
        header.classList.add('reveal-scale');
        revealObserver.observe(header);
    });

    // Contact form and info
    const contactForm = document.querySelector('.contact-form-container');
    const contactInfo = document.querySelector('.contact-info-container');
    
    if (contactForm) {
        contactForm.classList.add('reveal-left');
        revealObserver.observe(contactForm);
    }
    
    if (contactInfo) {
        contactInfo.classList.add('reveal-right');
        revealObserver.observe(contactInfo);
    }

    // GD Intro content
    const gdIntro = document.querySelector('.gd-intro-content');
    if (gdIntro) {
        gdIntro.classList.add('reveal');
        revealObserver.observe(gdIntro);
    }

    // Requirement columns
    const reqCols = document.querySelectorAll('.req-col');
    reqCols.forEach((col, index) => {
        col.classList.add(index === 0 ? 'reveal-left' : 'reveal-right');
        revealObserver.observe(col);
    });
});

// ===== LEGACY SCROLL ANIMATIONS (kept for compatibility) =====
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for animation (legacy support)
document.querySelectorAll('.course-card, .identity-card, .req-col').forEach(el => {
    if (!el.classList.contains('reveal') && 
        !el.classList.contains('reveal-left') && 
        !el.classList.contains('reveal-right') &&
        !el.classList.contains('stagger-item')) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    }
});

// ===== LAZY LOADING IMAGES =====
if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        img.src = img.dataset.src || img.src;
    });
} else {
    // Fallback for browsers that don't support lazy loading
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(script);
}

// ===== PERFORMANCE OPTIMIZATION =====
// Debounce function for scroll events
function debounce(func, wait = 10, immediate = true) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Apply debounce to scroll events
window.addEventListener('scroll', debounce(() => {
    highlightNavLink();
}, 15));

// ===== COURSE ENROLLMENT TRACKING =====
document.querySelectorAll('.course-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        const courseTitle = btn.closest('.course-card').querySelector('.course-title').textContent;
        console.log(`User interested in: ${courseTitle}`);
        
        // Optional: Track with analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'course_interest', {
                'event_category': 'Enrollment',
                'event_label': courseTitle
            });
        }
    });
});

// ===== WHATSAPP TRACKING =====
const whatsappFloat = document.querySelector('.whatsapp-float');
if (whatsappFloat) {
    whatsappFloat.addEventListener('click', () => {
        console.log('WhatsApp button clicked');
        
        // Optional: Track with analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'whatsapp_click', {
                'event_category': 'Contact',
                'event_label': 'WhatsApp Float Button'
            });
        }
    });
}

// ===== PREVENT FORM SPAM =====
let lastSubmitTime = 0;
const submitCooldown = 5000; // 5 seconds

if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        const currentTime = Date.now();
        if (currentTime - lastSubmitTime < submitCooldown) {
            e.preventDefault();
            alert('Please wait a few seconds before submitting again.');
            return false;
        }
        lastSubmitTime = currentTime;
    });
}

// ===== ACCESSIBILITY IMPROVEMENTS =====
// Add focus styles for keyboard navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'Tab') {
        document.body.classList.add('keyboard-nav');
    }
});

document.addEventListener('mousedown', () => {
    document.body.classList.remove('keyboard-nav');
});

// ===== CONSOLE BRANDING =====
console.log('%cGIBS COLLEGE', 'color: #6a0dad; font-size: 30px; font-weight: bold;');
console.log('%cTransform Your Creative Future', 'color: #666; font-size: 14px;');
console.log('%cWebsite developed with ❤️', 'color: #999; font-size: 12px;');

// ===== INITIALIZATION MESSAGE =====
console.log('✓ GIBS College website loaded successfully');
console.log('✓ All scripts initialized');