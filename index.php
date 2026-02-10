<?php
session_start();

if (!headers_sent()) {
    header("X-Frame-Options: SAMEORIGIN");
    header("X-Content-Type-Options: nosniff");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO & Search Engine Optimization -->
    <meta name="description"
        content="Join GIBS College for hands-on training in Graphics Design & Computer Packages. TVET certified programs. Enroll today at Githurai 45!">
    <meta name="keywords"
        content="graphics design course Githurai, computer packages training, GIBS College, graphic design diploma, TVET courses, Photoshop training, CorelDraw classes, certificate programs Kiambu">
    <meta name="author" content="GIBS College">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="GIBS College - Master Graphics & Computer Skills">
    <meta property="og:description"
        content="TVET certified Diploma, Certificate & Short Courses in Graphic Design and Computer Packages. Start your creative career at Githurai 45.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.gibscollege.co.ke">
    <meta property="og:image" content="https://www.gibscollege.co.ke/images/og-banner.jpg">
    <meta property="og:site_name" content="GIBS College">
    <meta property="og:locale" content="en_KE">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="GIBS College - Graphics Design & Computer Training">
    <meta name="twitter:description"
        content="Learn practical skills. Get TVET certified. Launch your career. Enroll today!">
    <meta name="twitter:image" content="https://www.gibscollege.co.ke/images/twitter-card.jpg">

    <!-- Favicon -->
    <link rel="icon" href="./images/Logo/gibs-favicon.jpeg" type="image/x-icon">
    <link rel="canonical" href="https://www.gibscollege.co.ke">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="CSS/app.css">
    <title>GIBS College | Graphics Design & Computer Packages Training in Githurai</title>

</head>

<body>

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="loader"></div>
        <h2>GIBS College Loading...</h2>
    </div>

    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="contact-info">
            <span>📧 info@gibscollege.co.ke</span>
            <span>📍 Githurai 45, Kiambu</span>
            <span>📞 0707 730 777</span>
        </div>
        <div class="social-links-top">
            <a target="_blank" href="https://www.facebook.com/share/1AG3kagkyU/" rel="noopener noreferrer"
                aria-label="Follow Gibs College on Facebook"><i class="fab fa-facebook-f"></i></a>
            <a target="_blank" href="https://www.instagram.com/gibscollege/" rel="noopener noreferrer"
                aria-label="Follow Gibs College on Instagram"><i class="fab fa-instagram"></i></a>
            <a target="_blank" href="https://www.tiktok.com/@gibs.college?_r=1&_t=ZM-92xPrQ1k23f"
                rel="noopener noreferrer" aria-label="Follow Gibs College on TikTok"><i class="fab fa-tiktok"></i></a>

        </div>
        <div class="login">
            <a href="#">🔐 Login / Portal</a>
        </div>
    </div>


    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <div class="logo">
                <img src="images/gibs-logo.jpeg" alt="GIBS College Logo" class="logo-image">
                <span>GIBS COLLEGE</span>
            </div>

            <ul class="nav-links">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#mission">About</a></li>
                <li class="has-dropdown">
                    <a href="#courses">Courses</a>
                    <div class="mega-menu">
                        <div class="mega-menu-content">
                            <div class="mega-menu-column">
                                <h4>Graphic Design Programs</h4>
                                <ul>
                                    <li><a href="#courses">Diploma (TVET Level 6) - 2 Years</a></li>
                                    <li><a href="#courses">Certificate (TVET Level 5) - 1 Year</a></li>
                                    <li><a href="#courses">CorelDraw - 3 Months</a></li>
                                    <li><a href="#courses">Adobe Photoshop - 3 Months</a></li>
                                    <li><a href="#courses">Adobe Illustrator - 3 Months</a></li>
                                    <li><a href="#courses">Adobe InDesign - 3 Months</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>Computer Packages</h4>
                                <ul>
                                    <li><a href="#courses">Microsoft Word</a></li>
                                    <li><a href="#courses">Microsoft Excel</a></li>
                                    <li><a href="#courses">Microsoft PowerPoint</a></li>
                                    <li><a href="#courses">Microsoft Access</a></li>
                                    <li><a href="#courses">Microsoft Publisher</a></li>
                                    <li><a href="#courses">Internet & Email</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="#curriculum">What You'll Learn</a></li>
                <li><a href="#requirements">Admission</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>

            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#mission">About Us</a></li>
                <li class="has-dropdown mobile-dropdown-trigger">
                    <a href="javascript:void(0)">Courses <span class="dropdown-icon">▼</span></a>
                    <div class="mobile-submenu">
                        <h4>Graphic Design</h4>
                        <ul>
                            <li><a href="#courses">Diploma (2 Years)</a></li>
                            <li><a href="#courses">Certificate (1 Year)</a></li>
                            <li><a href="#courses">Short Courses (3 Months)</a></li>
                        </ul>
                        <h4>Computer Packages</h4>
                        <ul>
                            <li><a href="#courses">Microsoft Office Suite</a></li>
                            <li><a href="#courses">Internet & Email</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="#curriculum">What You'll Learn</a></li>
                <li><a href="#requirements">Admission</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Slider -->
    <div class="hero-slider" id="home">

        <div class="slide active">
            <img src="images/Graphic-design-software.jpg" class="slide-bg" alt="Students">
            <div class="slide-overlay"></div>
            <div class="content">
                <h1>Shape Your Creative Future</h1>
                <p>TVET Certified Diploma & Certificate Programs in Graphic Design</p>
                <a href="#courses" class="btn">View Courses</a>
            </div>
        </div>

        <div class="slide">
            <img src="images/Digital Skills.jpg" class="slide-bg" alt="Computer Skills">
            <div class="slide-overlay"></div>
            <div class="content">
                <h1>Master Digital Skills</h1>
                <p>Computer Packages: Microsoft Office, Internet & Email Training</p>
                <a href="#courses" class="btn">Enroll Now</a>
            </div>
        </div>

        <div class="slide">
            <img src="images/Adobe-tools.jpg" class="slide-bg" alt="Design Software">
            <div class="slide-overlay"></div>
            <div class="content">
                <h1>Industry-Standard Tools</h1>
                <p>Learn Photoshop, CorelDraw, Illustrator & InDesign from Experts</p>
                <a href="#courses" class="btn">Start Learning</a>
            </div>
        </div>

        <button class="arrow prev" onclick="moveSlide(-1)">❮</button>
        <button class="arrow next" onclick="moveSlide(1)">❯</button>

        <div class="slider-dots">
            <span class="dot active" onclick="goToSlide(0)"></span>
            <span class="dot" onclick="goToSlide(1)"></span>
            <span class="dot" onclick="goToSlide(2)"></span>
        </div>
    </div>

    <!-- Identity Section (Mission, Vision, Values) -->
    <div class="identity-section reveal" id="mission">
        <div class="section-header">
            <h2 class="section-title">Who We Are</h2>
            <p class="section-subtitle">Shaping Creative Professionals for Kenya's Digital Future</p>
        </div>
        <div class="identity-grid">
            <div class="identity-card">
                <div class="identity-icon">🎯</div>
                <h3>Our Mission</h3>
                <p>To inspire creativity, build digital skills and empower every student to shine in their career and
                    community.</p>
            </div>
            <div class="identity-card">
                <div class="identity-icon">👁️</div>
                <h3>Our Vision</h3>
                <p>To be a vibrant community hub that transforms lives through accessible, skill-based education,
                    empowering individuals with creativity, technology, and self-reliance for a better future.</p>
            </div>
            <div class="identity-card">
                <div class="identity-icon">💎</div>
                <h3>Core Values</h3>
                <ul class="values-list">
                    <li><strong>Accessibility & Inclusion:</strong> Quality education accessible to all, regardless of
                        background.</li>
                    <li><strong>Creativity & Innovation:</strong> Creative thinking and innovative use of technology to
                        solve real-world problems.</li>
                    <li><strong>Empowerment & Self-Reliance:</strong> Skills, confidence, and independence to shape your
                        own future.</li>
                    <li><strong>Integrity & Professionalism:</strong> Honesty, respect, and high ethical standards in
                        learning and practice.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Graphic Design Introduction Section -->
    <div class="gd-intro-section reveal" id="gd-intro">
        <div class="gd-intro-container">
            <div class="section-header">
                <h2 class="section-title">Graphic Design Courses at GIBS College</h2>
                <p class="section-subtitle">Shaping Creative Professionals for Kenya's Digital Future</p>
            </div>
            <div class="gd-intro-content">
                <p>At GIBS College, our Graphic Design courses are built for learners who want more than theory. Each
                    program is structured to develop creative thinking, technical expertise, and real-world
                    problem-solving skills. Students gain hands-on experience in visual communication, typography,
                    branding, digital illustration, image manipulation, and layout design using industry-relevant tools
                    and workflows.</p>
            </div>
        </div>
    </div>

    <!-- Why Choose GIBS Section -->
    <div class="why-choose-section reveal">
        <div class="section-header">
            <h2 class="section-title">Why Choose GIBS College?</h2>
            <p class="section-subtitle">Your Success is Our Priority</p>
        </div>
        <div class="why-choose-grid">
            <div class="why-card">
                <div class="why-icon">🎯</div>
                <h3>Hands-on, Practical Training</h3>
                <p>Learn by doing. Our courses emphasize practical, real-world applications that prepare you for
                    immediate employment.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">📚</div>
                <h3>Industry-Relevant Curriculum</h3>
                <p>Stay ahead with courses updated regularly to reflect the latest industry trends, tools, and best
                    practices.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">⏰</div>
                <h3>Flexible Learning Options</h3>
                <p>Study at your own pace with flexible schedules designed for students, working professionals, and
                    career changers.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">🤝</div>
                <h3>Supportive Learning Environment</h3>
                <p>Experience personalized attention from expert instructors in a collaborative and encouraging
                    atmosphere.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">💼</div>
                <h3>Workplace-Ready Skills</h3>
                <p>Graduate with skills aligned with current workplace demands, ensuring you're job-ready from day one.
                </p>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <div class="courses-section reveal" id="courses">
        <div class="section-header">
            <h2 class="section-title">Our Programs</h2>
            <p class="section-subtitle">Shaping Creative Professionals for Kenya's Digital Future</p>
        </div>
        <div class="courses-grid">

            <!-- Diploma Program -->
            <div class="course-card">
                <img src="images/Graphic-design-software.jpg" alt="Diploma" class="course-image">
                <div class="course-content">
                    <span class="course-category">TVET Level 6</span>
                    <h3 class="course-title">Diploma in Graphic Design</h3>
                    <p class="course-desc">Comprehensive training for professional careers. Blends design theory,
                        practical studio work, advanced software training, and continuous portfolio development.</p>
                    <div class="course-pricing">
                        <span class="price-tag">KES 22,500 / Semester</span>
                        <span class="price-note">Payable in 3 instalments (KES 7,100/month)</span>
                    </div>
                    <div class="course-meta">
                        <span class="course-duration">⏱️ 2 Years (8 Semesters) + Attachment</span>
                        <a href="./pages/register.html" class="course-btn">Enroll</a>
                    </div>
                    <p>EXAM: Internal/CDAAC</p>
                </div>
            </div>

            <!-- Certificate Program -->
            <div class="course-card">
                <img src="https://images.unsplash.com/photo-1572044162444-ad60f128bdea?q=80&w=800&auto=format&fit=crop"
                    alt="Certificate" class="course-image">
                <div class="course-content">
                    <span class="course-category">TVET Level 5</span>
                    <h3 class="course-title">Certificate in Graphic Design</h3>
                    <p class="course-desc">Designed for beginners and emerging creatives. Introduces core concepts and
                        tools with practical skills for entry-level roles or freelance work.</p>
                    <div class="course-pricing">
                        <span class="price-tag">KES 22,500 / Semester</span>
                        <span class="price-note">Payable in 3 instalments (KES 7,100/month)</span>
                    </div>
                    <div class="course-meta">
                        <span class="course-duration">⏱️ 1 Year (4 Semesters)</span>
                        <a href="./pages/register.html" class="course-btn">Enroll</a>
                    </div>
                    <p>EXAM: Internal/CDAAC</p>
                </div>
            </div>

            <!-- Short Courses -->
            <div class="course-card">
                <img src="images/graphics-design.jpg" alt="Short Courses" class="course-image">
                <div class="course-content">
                    <span class="course-category">Skill Upgrade</span>
                    <h3 class="course-title">Graphic Design Short Courses</h3>
                    <p class="course-desc">Focused, skills-driven programs: CorelDraw, Adobe Photoshop, Illustrator, or
                        InDesign. Ideal for quick upskilling or creative exploration.</p>
                    <div class="course-pricing">
                        <span class="price-tag">KES 22,500 / Course</span>
                        <span class="price-note">Payable in 3 instalments (KES 7,100/month)</span>
                    </div>
                    <div class="course-meta">
                        <span class="course-duration">⏱️ 3 Months (1 Semester)</span>
                        <a href="./pages/register.html" class="course-btn">Enroll</a>
                    </div>
                    <p>EXAM: Internal</p>
                </div>
            </div>

            <!-- Computer Packages -->
            <div class="course-card">
                <img src="images/microsoft-office-365.jpg" alt="Computer Packages" class="course-image">
                <div class="course-content">
                    <span class="course-category">Essential Skills</span>
                    <h3 class="course-title">Computer Packages</h3>
                    <p class="course-desc">Practical digital skills for today's workplace: Microsoft Word, Excel,
                        Access, PowerPoint, Publisher, Internet & Email communication.</p>
                    <div class="course-pricing">
                        <span class="price-tag">Practical Training</span>
                        <span class="price-note">Certificate upon completion</span>
                    </div>
                    <div class="course-meta">
                        <span class="course-duration">⏱️ 1-3 Months</span>
                        <a href="./pages/register.html" class="course-btn">Enroll</a>
                    </div>
                    <p>For beginners, students, and office
                        staff</p>
                </div>
            </div>

        </div>
    </div>

    <!-- What You'll Learn Section -->
    <div class="curriculum-section reveal" id="curriculum">
        <div class="section-header">
            <h2 class="section-title">What You Will Learn</h2>
            <p class="section-subtitle">Core Skills and Areas of Study in Graphic Design</p>
        </div>
        <div class="curriculum-grid">
            <div class="curriculum-card">
                <div class="curriculum-icon">🎨</div>
                <h3>Design Fundamentals</h3>
                <p>Understand colour usage, layout structure, balance, alignment, and visual hierarchy to create
                    impactful designs.</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon">✒️</div>
                <h3>Typography</h3>
                <p>Learn how to select, combine, and apply fonts effectively to enhance readability and communicate
                    messages professionally.</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon">🎯</div>
                <h3>Branding & Visual Identity</h3>
                <p>Develop skills in logo design, brand systems, and visual storytelling to create consistent and
                    memorable brand identities.</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon">💻</div>
                <h3>Digital Design Software</h3>
                <p>Gain practical experience using industry-relevant tools for image editing, vector graphics, and
                    creative design production.</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon">📄</div>
                <h3>Print & Layout Design</h3>
                <p>Create professional posters, flyers, brochures, magazines, and other print materials with attention
                    to detail and production standards.</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon">🖌️</div>
                <h3>Digital Illustration</h3>
                <p>Explore modern digital techniques for illustration, drawing, and visual expression using creative
                    tools and software.</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon">📱</div>
                <h3>Introduction to UI/UX Design</h3>
                <p>Learn the basics of user interface and user experience design, focusing on how visuals improve
                    usability for websites and mobile applications.</p>
            </div>
            <div class="curriculum-card">
                <div class="curriculum-icon">📁</div>
                <h3>Portfolio Development</h3>
                <p>Build a strong professional portfolio that showcases your creativity, skills, and design thinking to
                    potential employers or clients.</p>
            </div>
        </div>
    </div>

    <!-- Admission Requirements Section -->
    <div class="requirements-section reveal" id="requirements">
        <div class="section-header">
            <h2 class="section-title">Admission Requirements</h2>
            <p class="section-subtitle">What you need to join GIBS College</p>
        </div>
        <div class="req-container">
            <div class="req-col">
                <h3><i class="fas fa-file-signature"></i> Admission Process</h3>
                <ul class="req-list">
                    <li>Complete and submit the application form</li>
                    <li>Pay non-refundable application fee: <strong>Ksh 1,000</strong></li>
                    <li>Attach two recent passport-sized photos</li>
                    <li>Provide a copy of your National ID or Passport</li>
                    <li><strong>Certificate Programs:</strong> Minimum Grade D-</li>
                    <li><strong>Diploma Programs:</strong> Minimum Grade C-</li>
                    <li><strong>Short Courses:</strong> No prior grades required</li>
                    <li>Bring one A4 PVC Lever Arch Box File (any colour)</li>
                    <li>Receive your admission letter confirming acceptance</li>
                    <li>Pay school fees before start of classes (up to 3 instalments allowed)</li>
                </ul>
            </div>
            <div class="req-col">
                <h3><i class="fas fa-toolbox"></i> Class Requirements</h3>
                <ul class="req-list">
                    <li>Pencils (H, B, HB, 3B, 4B, 6B)</li>
                    <li>Mechanical Pencil & Leads (2B, HB, 6B)</li>
                    <li>Kneaded Eraser</li>
                    <li>Hard Cover A4 & A3 Sketch Books</li>
                    <li>Fixative Spray</li>
                    <li>Ink Pens (0.5, 0.6, 0.8)</li>
                    <li>Pencil Pouch</li>
                    <li>Steel Ruler (30cm, 60cm)</li>
                    <li>7.5m Tape Measure</li>
                    <li>Mathematical Set</li>
                    <li>64GB USB Flash Disk</li>
                    <li>1 Realm Foolscaps, 3 Spring Files</li>
                    <li>Laptop (Core i5+, 8GB RAM min)</li>
                    <li>250GB SSD, 2GB Graphics</li>
                    <li>500GB External Hard Disk (Optional)</li>
                    <li>Smart Phone</li>
                    <li>Pen & Notebook</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section" id="faq">
        <div class="section-header">
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>
        <div class="faq-container">
            <h3>Graphic
                Design Programs</h3>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Do I need prior experience to study Graphic Design?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>No prior design experience is required. Our Graphic Design programs are structured to accommodate
                        beginners while also supporting students with some background in design.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What software will I learn in the Graphic Design course?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Students are trained using industry-standard design tools, including Adobe Photoshop,
                        Illustrator, InDesign, CorelDraw, and other relevant creative software.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How long does the Graphic Design course take?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Course duration depends on the program selected. The Certificate course takes 1 year (4
                        semesters), the Diploma course takes 2 years (8 semesters plus attachment), and Short Courses
                        typically run for 3 months (1 semester).</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Will I graduate with a portfolio?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Yes. Portfolio development is a core part of our training. Students graduate with a professional
                        portfolio showcasing their creative projects and practical skills.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What career opportunities are available after completing the course?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Graduates can pursue careers such as Graphic Designer, Brand Designer, Digital Designer, Creative
                        Assistant, or work as freelance designers in various industries.</p>
                </div>
            </div>

            <h3 class="computer-packages">Computer Packages</h3>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Do I need prior computer knowledge to join?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>No prior experience is required. The course starts with basic computer fundamentals and gradually
                        progresses to more advanced office applications.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How long does the Computer Packages course take?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>The duration depends on the program chosen. Computer packages certificate courses typically take
                        1 to 3 months.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What computer applications will I learn?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Students learn commonly used office applications, including Microsoft Word, Excel, PowerPoint,
                        Access, Publisher, Internet and Email usage, and basic file management.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Will I receive a certificate after completion?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Yes. Upon successful completion, students receive a certificate from GIBS College.
                        TVET-accredited programs also follow the relevant certification guidelines.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Are the classes practical or theory-based?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>The training is mainly practical. Students work on real tasks and exercises to build confidence
                        and workplace-ready skills.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section reveal" id="contact">
        <div class="section-header">
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">Start your journey at GIBS College today</p>
        </div>
        <div class="contact-wrapper">
            <!-- Contact Form -->
            <div class="contact-form-container">
                <form class="contact-form" action="./form-handler/contact.php" method="POST">
    <!-- Hidden input to ensure POST array is never empty even if submit button value is lost -->
    <input type="hidden" name="form_submission" value="1">
    <!-- CSRF Protection -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    
    <!-- Honeypot for spam detection -->
    <div style="display: none;">
        <input type="text" name="website" tabindex="-1" autocomplete="off">
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label for="fullname">Full Name *</label>
            <input type="text" id="fullname" name="name" required maxlength="100">
        </div>
        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" required maxlength="100">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required maxlength="15" pattern="^\+?[0-9]{7,15}$" title="Please enter a valid phone number (7-15 digits)">
        </div>
    </div>
    
    <div class="form-group">
        <label for="course">Course of Interest *</label>
        <select name="course" id="course" required>
            <option value="">Select a course</option>
            <option value="diploma">Diploma in Graphic Design (2 Years)</option>
            <option value="certificate">Certificate in Graphic Design (1 Year)</option>
            <option value="coreldraw">CorelDraw (3 Months)</option>
            <option value="photoshop">Adobe Photoshop (3 Months)</option>
            <option value="illustrator">Adobe Illustrator (3 Months)</option>
            <option value="indesign">Adobe InDesign (3 Months)</option>
            <option value="packages">Computer Packages (1-3 Months)</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="message">Message *</label>
        <textarea rows="4" name="message" id="message" required maxlength="1000"></textarea>
        <small>Maximum 1000 characters</small>
    </div>
    
   <button type="submit" name="submit" class="submit-btn">
  <span class="btn-text">Send Message</span>
</button>
    
    <!-- <div class="form-success">
        ✓ Thank you! Your message has been sent. We'll contact you soon.
    </div> -->
</form>
            </div>

            <!-- Contact Information -->
            <div class="contact-info-container">
                <div class="contact-info-card">
                    <div class="contact-info-icon">📞</div>
                    <div>
                        <h3>WhatsApp / Call</h3>
                        <p><strong>0707 730 777</strong></p>
                        <p>Available Mon-Sat, 8AM-6PM</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">📧</div>
                    <div>
                        <h3>Email Us</h3>
                        <p>info@gibscollege.co.ke</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">📍</div>
                    <div>
                        <h3>Visit Us</h3>
                        <p>Githurai 45<br>Kiambu County, Kenya</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">🕒</div>
                    <div>
                        <h3>Office Hours</h3>
                        <p>Monday - Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 4:00 PM<br>Sunday: Closed</p>
                    </div>
                </div>
                <div class="contact-map">
                    <iframe name="site-map" title="Map showing location of GLATEX Plaza"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.935446530098!2d36.9187849!3d-1.2053645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f3fc8a3ade4c3%3A0xa693352427377e80!2sGLATEX%20PLAZA!5e0!3m2!1sen!2ske!4v1769078040513!5m2!1sen!2ske"
                        width="100%" height="450" allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>GIBS COLLEGE</h3>
                <p>Empowering individuals with creativity, technology, and self-reliance for a better future through
                    accessible, skill-based education.</p>
                <div class="social-links">
                    <a target="_blank" href="https://www.facebook.com/share/1AG3kagkyU/" rel="noopener noreferrer"
                        aria-label="Follow Gibs College on Facebook" class="social-icon"><i
                            class="fab fa-facebook-f"></i></a>
                    <a target="_blank" href="https://www.instagram.com/gibscollege/" rel="noopener noreferrer"
                        aria-label="Follow Gibs College on Instagram" class="social-icon"><i
                            class="fab fa-instagram"></i></a>
                    <a target="_blank" href="https://www.tiktok.com/@gibs.college?_r=1&_t=ZM-92xPrQ1k23f"
                        rel="noopener noreferrer" aria-label="Follow Gibs College on TikTok" class="social-icon"><i
                            class="fab fa-tiktok"></i></a>

                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#mission">About Us</a></li>
                    <li><a href="#courses">Diploma Programs</a></li>
                    <li><a href="#courses">Certificate Programs</a></li>
                    <li><a href="#courses">Short Courses</a></li>
                    <li><a href="#requirements">Admission</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Programs</h3>
                <ul>
                    <li><a href="#courses">Graphic Design Diploma</a></li>
                    <li><a href="#courses">Graphic Design Certificate</a></li>
                    <li><a href="#courses">Computer Packages</a></li>
                    <li><a href="#curriculum">What You'll Learn</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <ul>
                    <li>📞 0707 730 777</li>
                    <li>📧 info@gibscollege.co.ke</li>
                    <li>📍 Githurai 45, Kiambu</li>
                    <li><a href="https://maps.app.goo.gl/PH5GXFWpW8EjYvRo9" rel="noopener noreferrer"
                            aria-label="Get Directions to Gibs College" target="_blank">Get Directions</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 GIBS College. All rights reserved. | TVET Certified Institution</p>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/254707730777?text=Hello%20GIBS%20College,%20I%20am%20interested%20in%20your%20courses."
        rel="noopener noreferrer" aria-label="Chat with Gibs College on WhatsApp" class="whatsapp-float" target="_blank"
        title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scroll to Top -->
    <div class="scroll-top" id="scrollTop" onclick="scrollToTop()">↑</div>

    <!-- JavaScript -->
    <script src="JS/app.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var messageText = "<?=$_SESSION['status'] ?? ''?>";
        if (messageText != '') {
            Swal.fire({
                title: "Thank you",
                text: messageText,
                icon: "success"
            });
            <?php unset($_SESSION['status']); ?>
        }
    </script>
</body>

</html>