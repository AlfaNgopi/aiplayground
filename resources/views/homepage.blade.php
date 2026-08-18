<!DOCTYPE html>
<html lang="id">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Alfa Nada Yulaswara</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Saira+Extra+Condensed:wght@500;700&display=swap" rel="stylesheet">

    <!-- Core theme CSS (includes Bootstrap)-->

    <!-- handle sidebar styling -->
    <style>
        /* Custom CSS to define the width and behavior */
        .sidebar {
            height: 100vh;
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 280px;
            /* Must match the sidebar width */
            padding: 20px;
        }

        /* Mobile Responsive: Stack them on small screens */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
            --accent-color: #0d6efd;
            --sidebar-bg: #1a1d20;
            --section-padding: 6rem 2rem;
            --card-radius: 1.25rem;

        }

        /* for mobile devices */
        @media (max-width: 768px) {
            :root {
                --section-padding: 0;
                /* Or a smaller value like 10px */
            }
        }

        body {
            /* Layer 1: The Texture Image | Layer 2: The Color Gradient */
            background-color: #e4e4e4;
            /* background-color: #fffcfc; */
            background-image: url("https://www.transparenttextures.com/patterns/always-grey.png");
            background-repeat: repeat;
            /* Centering the background and allowing it to "overhang" the edges */
            background-position: calc(50% + var(--move-x)) calc(50% + var(--move-y));
            transition: background-position 0.2s cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* Animated Ambient background glow */




        /* Scroll Progress Bar */
        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: var(--primary-gradient);
            z-index: 2000;
            width: 0%;
            transition: width 0.1s ease-out;
        }

        h1,
        h2,
        h3,
        .subheading {
            font-family: 'Saira Extra Condensed', serif;
            text-transform: uppercase;
            font-weight: 700;
        }

        h1 {
            font-size: calc(2.5rem + 3vw);
            line-height: 0.9;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 3.5rem;
            color: #222;
            margin-bottom: 3rem;
            position: relative;
        }

        h2::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .text-primary {
            color: var(--accent-color) !important;
        }

        /* Modern Sidebar */
        .sidebar {
            width: 17rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            background-color: #000000;
            background-image: url("https://www.transparenttextures.com/patterns/45-degree-fabric-light.png");
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main-content {
            left: 0;

        }

        .nav-link {
            font-weight: 700;
            letter-spacing: 0.1rem;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.4) !important;
            padding: 1rem 2rem;
            transition: 0.3s all;
            border-left: 4px solid transparent;
        }

        .nav-link:hover {
            color: #fff !important;
            padding-left: 2.5rem;
        }

        .nav-link.active {
            color: #fff !important;
            background: rgba(13, 110, 253, 0.1);
            border-left: 4px solid var(--accent-color);
        }

        /* Section Layouts */
        section.resume-section {
            padding: var(--section-padding);
            min-height: 100vh;
            display: flex;
            align-items: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        section.resume-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Project Cards - Hover Magic */
        .project-card {
            border: none;
            border-radius: var(--card-radius);
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
        }

        .project-card:hover {
            transform: translateY(-12px) scale(1.01);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .carousel-item img {
            height: 400px;
            object-fit: contain;
            transition: transform 0.5s ease;

        }

        .project-card:hover .carousel-item img {
            transform: scale(1.05);
        }

        /* Badge Styling */
        .badge-tech {
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 600;
            padding: 0.4rem 0.9rem;
            border-radius: 2rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.75rem;
            border: 1px solid transparent;
            transition: 0.3s all;
            display: inline-block;
        }

        .project-card:hover .badge-tech {
            border-color: rgba(13, 110, 253, 0.2);
            background-color: #fff;
            color: var(--accent-color);
        }

        /* Social Icons */
        .social-icons .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 3.5rem;
            width: 3.5rem;
            background-color: #f8f9fa;
            color: #333;
            border-radius: 12px;
            font-size: 1.4rem;
            margin-right: 1rem;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .social-icons .social-icon:hover {
            background: var(--primary-gradient);
            color: #fff;
            transform: rotate(-8deg) translateY(-5px);
        }

        /* Buttons */
        .btn-custom {
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        /* Skills Icon Grid */
        .skill-item {
            text-align: center;
            padding: 1.5rem;
            border-radius: 15px;
            transition: 0.3s all;
        }

        .skill-item:hover {
            background: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .skill-item i {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            display: block;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 2rem 0;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar .d-lg-block {
                display: block !important;
            }

            .nav {
                flex-direction: row !important;
                justify-content: center;
                flex-wrap: wrap;
            }

            .nav-link {
                padding: 0.5rem 1rem;
                border-left: none;
                border-bottom: 3px solid transparent;
            }

            .nav-link.active {
                border-left: none;
                border-bottom: 3px solid var(--accent-color);
            }
        }
    </style>

</head>


<body>
    <div id="scroll-progress"></div>

    <!-- Navigation -->
    <nav class="sidebar text-white" id="sideNav">
        <div class="text-center mb-4">
            <div class="position-relative d-inline-block">
                <div class="rounded-circle border border-4 border-primary mx-auto mb-3" style="width: 140px; height: 140px; overflow: hidden; background: #222;">
                    <img src="assets/profile.jpg" alt="Profile Picture" class="img-fluid rounded-circle" onerror="this.src='https://via.placeholder.com/140?text=Profile+Picture'">
                </div>
            </div>
            <h5 class="text-white mb-0 fw-bold">ALFA YULASWARA</h5>
            <small class="text-white">Fullstack Developer</small>
        </div>
        <ul class="nav flex-column mt-2">
            <li class="nav-item"><a class="nav-link active" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
            <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
            <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
            <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div class="main-content">

        <!-- About Section -->
        <section class="resume-section" id="about">
            <div class="resume-section-content mb-1">
                <div class="badge bg-primary px-3 py-2 mb-3 rounded-pill" style="letter-spacing: 2px;">AVAILABLE FOR HIRE</div>
                <h1 class="mb-0">
                    Alfa Nada <span class="text-primary">Yulaswara</span>
                </h1>
                <div class="subheading mb-4 fs-3 opacity-75">
                    S.Kom Informatics Graduate
                </div>
                <p class="lead mb-5"><strong>
                        Informatics graduate with hands-on experience in Fullstack Development and AI integration (GPA: 3.47).
                        Passionate about building scalable applications and leveraging AI technologies. Experienced in server-side logic,
                        responsive UI design, and bridging complex systems with user-friendly interfaces.</strong>
                </p>
                <div class="social-icons mb-5">
                    <a class="social-icon" href="https://github.com/alfangopi" target="_blank"><i class="fab fa-github"></i></a>
                    <a class="social-icon" href="https://wa.me/6281234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a class="social-icon" href="mailto:alfayulaswara@gmail.com"><i class="fas fa-envelope"></i></a>
                </div>
                <a href="#projects" class="btn btn-primary btn-custom px-5 py-3 ">View My Work <i class="fas fa-arrow-right ms-2 "></i></a>
            </div>
        </section>

        <hr class="m-0">

        <!-- Experience -->
        <section class="resume-section" id="experience">
            <div class="resume-section-content">
                <h2 class="mb-5">Experience</h2>

                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0 h4">Fullstack Website Developer</h3>
                        <div class="subheading mb-3 fs-5">Local Government (Pemda)</div>
                        <p>Designed database architectures and implemented server-side logic using CodeIgniter. Developed responsive and intuitive User Interfaces to ensure high accessibility for public users.</p>
                    </div>
                    <div class="flex-shrink-0"><span class="text-primary fw-bold">Dec 2024 - Mar 2025</span></div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0 h4">Assistant Lecturer of Intro to AI</h3>
                        <div class="subheading mb-3 fs-5">Universitas Atma Jaya Yogyakarta</div>
                        <ul>
                            <li>Teaching basic concepts of Artificial Intelligence and its applications.</li>
                            <li>Guided students in Python-based AI project implementation.</li>
                            <li>Curated curriculum materials to bridge theoretical concepts with practical coding skills.</li>
                        </ul>
                    </div>
                    <div class="flex-shrink-0"><span class="text-primary fw-bold">Jul 2023 - Dec 2023</span></div>
                </div>
            </div>
        </section>

        <hr class="m-0">

        <!-- Education -->
        <section class="resume-section" id="education">
            <div class="resume-section-content">
                <h2 class="mb-5">Education</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0 h4">Universitas Atma Jaya Yogyakarta</h3>
                        <div class="subheading mb-2 fs-5">Bachelor of Informatics</div>
                        <p class="mb-0 text-muted">Major in Web Development & AI Implementation</p>
                        <p class="fw-bold">GPA: 3.47 / 4.00</p>
                    </div>
                    <div class="flex-shrink-0"><span class="text-primary fw-bold">2021 - 2025</span></div>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="flex-grow-1">
                        <h3 class="mb-0 h4">SMA Negeri 7 Purworejo</h3>
                        <div class="subheading mb-3 fs-5">High School Graduate</div>
                    </div>
                    <div class="flex-shrink-0"><span class="text-primary fw-bold">2018 - 2021</span></div>
                </div>
            </div>
        </section>

        <hr class="m-0">

        <!-- Projects -->
        <section class="resume-section visible" id="projects">
            <div class="resume-section-content">
                <h2 class="mb-5">Featured Projects</h2>

                <!-- Project Card 1: Thesis -->
                <div class="project-card mb-5">
                    <div class="row g-0">
                        <div class="col-12 col-lg-6">
                            <div id="carouselThesis" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="assets/project1/1.png" alt="Thesis Project" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project1/2.png" alt="Thesis Project" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project1/3.png" alt="Thesis Project" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project1/4.png" alt="Thesis Project" class="d-block w-100">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselThesis" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselThesis" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="p-4">
                                <h3 class="h4">AI-Driven Letter Classification</h3>
                                <div class="text-primary fw-bold mb-3">Thesis Project</div>
                                <p>Developed a specialized system to automate official letter code classification using the <strong>OpenAI API</strong>. Built with CodeIgniter, bridged with a Python Flask API, and utilized Zero-Shot Prompting.</p>
                                <div class="d-flex flex-wrap mb-4">
                                    <span class="badge-tech">CodeIgniter</span>
                                    <span class="badge-tech">Python Flask</span>
                                    <span class="badge-tech">OpenAI API</span>
                                    <span class="badge-tech">MySQL</span>
                                </div>
                                <a href="https://klasifikasikode.my.id" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill mb-1"><i class="fas fa-external-link-alt me-1"></i>Visit Link</a>
                                <a href="assets/jurnal.pdf" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill mb-1"><i class="fas fa-file-alt me-1"></i>Journal</a>
                                <a href="https://github.com/AlfaNgopi/klasifikator" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill"><i class="fab fa-github me-1"></i>Github Repository</a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Project Card 2: E-commerce -->
                <div class="project-card mb-5">
                    <div class="row g-0">
                        <div class="col-lg-6 order-lg-2">
                            <div id="carouselEcom" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="assets/project2/1.png" alt="E-commerce" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project2/2.png" alt="E-commerce" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project2/3.png" alt="E-commerce" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project2/4.png" alt="E-commerce" class="d-block w-100">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselEcom" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselEcom" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 order-lg-1">
                            <div class="p-4">
                                <h3 class="h4">Fullstack E-Commerce Platform</h3>
                                <div class="text-primary fw-bold mb-3">Group Project</div>
                                <p>Built a robust online marketplace with product management, secure authentication, and payment gateway simulation. Focused on responsive design and database optimization.</p>
                                <div class="d-flex flex-wrap mb-4">
                                    <span class="badge-tech">Laravel</span>
                                    <span class="badge-tech">JavaScript</span>
                                    <span class="badge-tech">Bootstrap</span>
                                    <span class="badge-tech">MySQL</span>
                                </div>
                                <a href="https://p3l-production.up.railway.app/" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill"><i class="fas fa-external-link-alt me-1"></i>Demo</a>
                                <a href="https://github.com/AlfaNgopi/P3l" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill"><i class="fab fa-github me-1"></i>Github Repository</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Card 3: Pemda Web -->
                <div class="project-card mb-5">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div id="carouselPemda" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="assets/project3/1.png" alt="Pemda Application" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project3/2.png" alt="Pemda Application" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project3/3.png" alt="Pemda Application" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project3/4.png" alt="Pemda Application" class="d-block w-100">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPemda" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselPemda" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-4">
                                <h3 class="h4">Fullstack Web Application</h3>
                                <div class="text-primary fw-bold mb-3">Local Government (Pemda)</div>
                                <p>Developing a comprehensive internal system for the news of regional inspectorate. Focused on UI design, accessibility, and multi-level user access control.</p>
                                <div class="d-flex flex-wrap mb-4">
                                    <span class="badge-tech">Code Igniter</span>
                                    <span class="badge-tech">API Integration</span>
                                    <span class="badge-tech">Bootstrap</span>
                                    <span class="badge-tech">PostgreSQL</span>
                                </div>
                                <a href="https://inspektorat.purworejokab.go.id/baru/" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill"><i class="fas fa-external-link-alt me-1"></i>Visit Link</a>
                                <a href="https://github.com/AlfaNgopi/uiinspektorat" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill"><i class="fab fa-github me-1"></i>Github Repository</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Card 4: Mobile App -->
                <div class="project-card mb-5">
                    <div class="row g-0">
                        <div class="col-lg-6 order-lg-2">
                            <div id="carouselMobile" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="assets/project4/1.png" alt="Mobile Project" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project4/2.png" alt="Mobile Project" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project4/3.png" alt="Mobile Project" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/project4/4.png" alt="Mobile Project" class="d-block w-100">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMobile" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselMobile" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 order-lg-1">
                            <div class="p-4">
                                <h3 class="h4">Fullstack Mobile App</h3>
                                <div class="text-primary fw-bold mb-3">Independent Project</div>
                                <p>A cross-platform mobile application built to facilitate community services during field study (KKN). Includes real-time data sync and offline capabilities.</p>
                                <div class="d-flex flex-wrap mb-4">
                                    <span class="badge-tech">Flutter</span>
                                    <span class="badge-tech">Dart</span>
                                    <span class="badge-tech">Firebase</span>
                                    <span class="badge-tech">NoSQL</span>
                                </div>
                                <a href="https://github.com/AlfaNgopi/appkkn" target="_blank" class="btn btn-sm btn-outline-primary px-4 rounded-pill"><i class="fab fa-github me-1"></i>Github Repository</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <hr class="m-0">

        <!-- Skills -->
        <section class="resume-section" id="skills">
            <div class="resume-section-content">
                <h2 class="mb-5">Skills</h2>
                <div class="subheading mb-3 fs-5">Programming Languages</div>
                <ul class="list-inline mb-5" style="font-size: 3rem;">
                    <li class="list-inline-item text-primary" title="PHP"><i class="fab fa-php"></i></li>
                    <li class="list-inline-item text-primary" title="Python"><i class="fab fa-python"></i></li>
                    <li class="list-inline-item text-primary" title="JavaScript"><i class="fab fa-js-square"></i></li>
                    <li class="list-inline-item text-primary" title="Java"><i class="fab fa-java"></i></li>
                    <li class="list-inline-item text-primary" title="HTML5"><i class="fab fa-html5"></i></li>
                    <li class="list-inline-item text-primary" title="CSS3"><i class="fab fa-css3-alt"></i></li>
                </ul>

                <div class="row">
                    <div class="col-md-6">
                        <div class="subheading mb-3 fs-5">Frameworks & Platforms</div>
                        <ul class="fa-ul mb-0">
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> Laravel & CodeIgniter</li>
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> Flutter & Dart (Android)</li>
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> NodeJS & Express</li>
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> Python Flask</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="subheading mb-3 fs-5">Tools & AI</div>
                        <ul class="fa-ul mb-0">
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> OpenAI API & Prompt Engineering</li>
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> Firebase & Cloud Hosting</li>
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> SQL (MySQL, PostgreSQL)</li>
                            <li><span class="fa-li text-primary"><i class="fas fa-check"></i></span> Git & Version Control</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Scroll Progress
            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                document.getElementById("scroll-progress").style.width = scrolled + "%";
            });

            // Intersection Observer for Section Animations
            const sections = document.querySelectorAll("section");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");

                        // Update Nav Link
                        const id = entry.target.getAttribute("id");
                        document.querySelectorAll(".nav-link").forEach(link => {
                            link.classList.toggle("active", link.getAttribute("href") === `#${id}`);
                        });
                    }
                });
            }, {
                threshold: 0.2
            });

            sections.forEach(s => observer.observe(s));
        });
    </script>


</body>


<script>
    window.addEventListener('DOMContentLoaded', event => {

        // Activate Bootstrap scrollspy on the main nav element
        const sideNav = document.body.querySelector('#sideNav');
        if (sideNav) {
            new bootstrap.ScrollSpy(document.body, {
                target: '#sideNav',
                rootMargin: '0px 0px -40%',
            });
        };

        // Collapse responsive navbar when toggler is visible
        const navbarToggler = document.body.querySelector('.navbar-toggler');
        const responsiveNavItems = [].slice.call(
            document.querySelectorAll('#navbarResponsive .nav-link')
        );
        responsiveNavItems.map(function(responsiveNavItem) {
            responsiveNavItem.addEventListener('click', () => {
                if (window.getComputedStyle(navbarToggler).display !== 'none') {
                    navbarToggler.click();
                }
            });
        });

    });
</script>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->

<script>
    window.addEventListener('mousemove', (e) => {
        // Calculate how far the mouse is from the center of the screen
        const x = (window.innerWidth / 2 - e.clientX) / 50;
        const y = (window.innerHeight / 2 - e.clientY) / 50;

        document.body.style.setProperty('--move-x', x + 'px');
        document.body.style.setProperty('--move-y', y + 'px');
    });
</script>

</html>