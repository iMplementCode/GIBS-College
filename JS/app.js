
        // --- PRELOADER ---
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('preloader').classList.add('hidden');
            }, 1500);
        });

        // --- MOBILE MENU FUNCTIONALITY (UPDATED FOR MEGA MENU) ---
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileDropdownTrigger = document.querySelector('.mobile-dropdown-trigger > a');
        const mobileSubmenu = document.querySelector('.mobile-submenu');

        // Toggle Main Mobile Menu
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });

        // Toggle Submenu (Mega Menu) on Mobile
        if (mobileDropdownTrigger) {
            mobileDropdownTrigger.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent jump to top
                mobileSubmenu.classList.toggle('open');
                mobileDropdownTrigger.parentElement.classList.toggle('open');
            });
        }

        // Close menu when clicking standard links
        document.querySelectorAll('.mobile-menu a:not(.mobile-dropdown-trigger > a)').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        // --- HERO SLIDER ---
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

        // --- TESTIMONIALS SLIDER ---
        let currentTestimonial = 0;
        const testimonialSlides = document.querySelectorAll('.testimonial-slide');
        const testimonialDots = document.querySelectorAll('.testimonial-dot');
        let testimonialInterval;

        function showTestimonial(index) {
            testimonialSlides.forEach(slide => slide.classList.remove('active'));
            testimonialDots.forEach(dot => dot.classList.remove('active'));

            if (index >= testimonialSlides.length) {
                currentTestimonial = 0;
            } else if (index < 0) {
                currentTestimonial = testimonialSlides.length - 1;
            } else {
                currentTestimonial = index;
            }

            testimonialSlides[currentTestimonial].classList.add('active');
            testimonialDots[currentTestimonial].classList.add('active');
        }

        function goToTestimonial(index) {
            showTestimonial(index);
            resetTestimonialTimer();
        }

        function resetTestimonialTimer() {
            clearInterval(testimonialInterval);
            testimonialInterval = setInterval(() => {
                currentTestimonial++;
                showTestimonial(currentTestimonial);
            }, 5000);
        }

        resetTestimonialTimer();

        // --- NAVBAR SCROLL EFFECT ---
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // --- SCROLL TO TOP ---
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

        // --- PROGRESS BAR ---
        const progressBar = document.getElementById('progressBar');
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.body.clientHeight - window.innerHeight;
            const scrollPercent = scrollTop / docHeight * 100;
            progressBar.style.width = scrollPercent + '%';
        });

        // --- ANIMATED COUNTER ---
        const counters = document.querySelectorAll('.counter');
        const statsSection = document.querySelector('.stats-section');

        function animateCounter(counter) {
            const target = +counter.getAttribute('data-target');
            const increment = target / 200;
            let current = 0;

            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 10);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        }

        // --- SCROLL ANIMATIONS ---
        const animatedElements = document.querySelectorAll('.stat-item, .feature-card, .course-card');

        function checkScroll() {
            animatedElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('animated');
                }
            });

            const statsTop = statsSection.getBoundingClientRect().top;
            if (statsTop < window.innerHeight - 100) {
                counters.forEach(counter => {
                    if (!counter.hasAttribute('data-animated')) {
                        animateCounter(counter);
                        counter.setAttribute('data-animated', 'true');
                    }
                });
            }
        }

        window.addEventListener('scroll', checkScroll);
        checkScroll();

        // --- FAQ ACCORDION ---
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

        // --- FORM VALIDATION ---
        const contactForm = document.getElementById('contactForm');
        const formInputs = contactForm.querySelectorAll('input, select, textarea');

        // Email validation regex
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        // Phone validation regex (Kenyan format)
        const phoneRegex = /^(\+254|0)[17]\d{8}$/;

        function validateField(field) {
            const value = field.value.trim();
            let isValid = true;
            let errorMessage = '';

            // Clear previous error
            field.classList.remove('error');

            if (field.hasAttribute('required') && value === '') {
                isValid = false;
                errorMessage = `Please enter your ${field.name.replace(/([A-Z])/g, ' $1').toLowerCase()}`;
            } else if (field.type === 'email' && !emailRegex.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            } else if (field.type === 'tel' && value !== '' && !phoneRegex.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid phone number (e.g., +254712345678 or 0712345678)';
            } else if (field.tagName === 'SELECT' && value === '') {
                isValid = false;
                errorMessage = 'Please select an option';
            } else if (field.name === 'firstName' || field.name === 'lastName') {
                if (value.length < 2) {
                    isValid = false;
                    errorMessage = 'Name must be at least 2 characters long';
                }
            } else if (field.name === 'message' && value.length < 10) {
                isValid = false;
                errorMessage = 'Message must be at least 10 characters long';
            }

            if (!isValid) {
                field.classList.add('error');
                const errorElement = field.parentElement.querySelector('.error-message');
                if (errorElement) {
                    errorElement.textContent = errorMessage;
                }
            }

            return isValid;
        }

        // Real-time validation
        formInputs.forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('input', () => {
                if (input.classList.contains('error')) {
                    validateField(input);
                }
            });
        });

        // Form submission
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            let isFormValid = true;

            // Validate all fields
            formInputs.forEach(input => {
                if (!validateField(input)) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Show loading state
                const submitBtn = contactForm.querySelector('.submit-btn');
                const btnText = submitBtn.querySelector('.btn-text');
                const btnLoader = submitBtn.querySelector('.btn-loader');

                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline';

                // Simulate form submission
                setTimeout(() => {
                    // Hide form
                    contactForm.querySelectorAll('.form-row, .form-group, .submit-btn').forEach(el => {
                        el.style.display = 'none';
                    });

                    // Show success message
                    const successMessage = contactForm.querySelector('.form-success');
                    successMessage.style.display = 'block';

                    // Reset form after 5 seconds
                    setTimeout(() => {
                        contactForm.reset();
                        contactForm.querySelectorAll('.form-row, .form-group, .submit-btn').forEach(el => {
                            el.style.display = '';
                        });
                        successMessage.style.display = 'none';
                        submitBtn.disabled = false;
                        btnText.style.display = 'inline';
                        btnLoader.style.display = 'none';
                    }, 5000);
                }, 2000);
            } else {
                // Scroll to first error
                const firstError = contactForm.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        // --- NOTIFICATION ---
        const notification = document.getElementById('notification');

        setTimeout(() => {
            notification.classList.add('active');
        }, 3000);

        setTimeout(() => {
            notification.classList.remove('active');
        }, 11000);

        // --- SMOOTH SCROLL FOR ANCHOR LINKS ---
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                // If link is inside mobile menu, skip standard scroll, handled by menu close
                if (this.closest('.mobile-menu')) return;

                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // --- ACTIVE NAV LINK ON SCROLL ---
        const sections = document.querySelectorAll('section[id], div[id]');
        const navLinks = document.querySelectorAll('.nav-links a, .mobile-menu a');

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

        // --- KEYBOARD SHORTCUTS ---
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                mobileMenu.classList.remove('active');
                menuToggle.classList.remove('active');
                document.body.style.overflow = '';
            }
            if (e.key === 'ArrowLeft') moveSlide(-1);
            if (e.key === 'ArrowRight') moveSlide(1);
        });