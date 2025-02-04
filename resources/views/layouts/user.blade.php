<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0A2647;      /* Navy blue */
            --secondary-color: #144272;     /* Slightly lighter navy */
            --accent-color: #205295;        /* Medium blue */
            --light-blue: #2C74B3;          /* Light blue */
            --bg-light: #e8f1f9;            /* Very light blue for background */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url("{{ asset('images/wisuda.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: #2c3e50;
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.85);
            z-index: 0;
            opacity: 0.5;
        }

        #sidebar, #content, .top-navbar {
            position: relative;
            z-index: 1;
        }

        .top-navbar {
            position: fixed;
            top: 0;
            padding-top: 20px;
            right: 0;
            left: 0;
            height: 50px;
            background: white;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .top-navbar.expanded {
            left: 80px;
        }

        /* Sidebar Styles */
        #sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        #sidebar.collapsed {
            width: 80px;
        }

        #sidebar.collapsed .nav-text,
        #sidebar.collapsed .logo-text {
            display: none;
        }

        /* Logo Section */
        .logo-section {
            padding: 2rem 1.5rem;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            margin-bottom: 1rem;
            position: relative;
        }

        .logo-section i {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        .logo-text {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
        }

        .logo-subtext {
            color: var(--light-blue);
            font-size: 0.9rem;
        }

        /* Toggle Arrow Button */
        .toggle-arrow {
            position: absolute;
            top: 50%;
            right: -25px;
            transform: translateY(-50%);
            width: 25px;
            height: 50px;
            background: var(--primary-color);
            border: none;
            border-radius: 0 25px 25px 0;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .toggle-arrow i {
            font-size: 18px;
            transition: all 0.3s ease;
        }

        /* Saat sidebar collapsed */
        #sidebar.collapsed .toggle-arrow i {
            transform: rotate(180deg);
        }

        /* Hover effect */
        .toggle-arrow:hover {
            background: var(--dark-blue);
            width: 30px;
            right: -30px;
        }

        /* Navigation Menu */
        .nav-menu {
            padding: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8) !important;
            border-radius: 10px;
            margin: 0.3rem 0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: var(--secondary-color);
            z-index: -1;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .nav-link:hover:before,
        .nav-link.active:before {
            width: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
            transform: translateX(5px);
        }

        .nav-icon {
            font-size: 1.4rem;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .nav-text {
            font-weight: 500;
            font-size: 1rem;
        }

        /* Content Area */
        #content {
            flex: 1;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        #content.expanded {
            margin-left: 80px;
        }

        /* Section Styles */
        .landing-section {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .landing-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        /* Home Section */
        #home {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            position: relative;
            overflow: hidden;
        }

        #home::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url('path/to/pattern.svg');
            opacity: 0.1;
            z-index: 1;
        }

        #home .content {
            position: relative;
            z-index: 2;
        }

        /* Add these styles to your existing <style> section */

.lead {
    font-size: 1.25rem;
    font-weight: 300;
}

.testimonial-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.testimonial-content {
    margin-bottom: 1rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.testimonial-author img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.social-links {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.social-links a {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.social-links a:hover {
    transform: translateY(-3px);
}

        /* Logout Button */
        .sidebar-logout {
            padding: 1rem;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding: 0.8rem;
            border-radius: 10px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -280px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                margin-left: 0;
            }

            #content.expanded {
                margin-left: 0;
            }

            .toggle-arrow {
                right: -25px;
            }
        }

        .footer-section {
            position: relative;
            color: white;
            margin-top: 4rem;
        }

        .footer-wave {
            position: relative;
            width: 100%;
            line-height: 0;
            font-size: 0;
        }

        .footer-wave svg {
            display: block;
            vertical-align: bottom;
            margin-bottom: -1px;
        }

        .footer-content {
            background: #0A2647; /* Warna baru yang lebih gelap */
            padding: 3rem 0 2rem;
            margin-top: -1px;
        }

        .footer-info h4, .footer-social h4 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #fff;
        }

        .contact-details p {
            margin: 0.5rem 0;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .contact-details i {
            margin-right: 10px;
            color: #2C74B3; /* Warna aksen biru muda */
        }

        .social-links {
            margin-top: 1.5rem;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #144272; /* Warna baru untuk icon social media */
            color: white;
            margin: 0 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: #205295; /* Warna hover yang lebih terang */
            color: white;
            transform: translateY(-3px);
        }

        .copyright {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
        }

        .copyright i {
            margin: 0 5px;
            animation: heartbeat 1.5s ease infinite;
        }

        @keyframes heartbeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>

<body>

<header>
    <nav class="top-navbar">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="navbar-brand">
                <span class="fw-bold text-primary">Tracer Study</span>
            </div>
            
            <div class="d-flex align-items-center">
                @auth
                    <div class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2">{{ Auth::user()->name }}</span>
                            <img class="rounded-circle" 
                                 src="{{ Auth::user()->avatar ? '/avatars/'.Auth::user()->avatar : asset('/images/images.png') }}"
                                 style="width: 40px; height: 40px; object-fit: cover;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow-sm">
                            <a class="dropdown-item" href="{{ route('profileUser.edit') }}">
                                <i class="bi bi-person me-2"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-person-plus"></i> Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>
</header>

@yield('content')

</body>
<!-- Add these scripts before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

</html>