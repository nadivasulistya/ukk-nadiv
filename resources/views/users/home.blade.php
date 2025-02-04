@extends('layouts.user')

@section('content')

<style>
                .footer-section {
                    position: relative;
                    color: white;
                    margin-top: 4rem;
                    overflow: hidden;
                }

                footer {
                    margin: 0 -32px -32px;
                }

                .footer-content {
                    background: #0A2647;
                    padding: 4rem 0 0;
                }

                .footer-brand {
                    text-align: center;
                }

                .footer-brand i {
                    color: #2C74B3;
                    margin-bottom: 1rem;
                }

                .footer-title {
                    color: white;
                    font-size: 1.25rem;
                    font-weight: 600;
                    margin-bottom: 1.5rem;
                    position: relative;
                    padding-bottom: 0.5rem;
                }

                .footer-title::after {
                    content: '';
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    width: 50px;
                    height: 2px;
                    background: #2C74B3;
                }

                .contact-details p {
                    margin: 0.8rem 0;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    color: rgba(255, 255, 255, 0.8);
                }

                .contact-details i {
                    color: #2C74B3;
                    font-size: 1.1rem;
                }

                .footer-links {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .footer-links li {
                    margin-bottom: 0.8rem;
                }

                .footer-links a {
                    color: rgba(255, 255, 255, 0.8);
                    text-decoration: none;
                    transition: all 0.3s ease;
                    display: inline-flex;
                    align-items: center;
                }

                .footer-links a:before {
                    content: '\F285';
                    font-family: 'Bootstrap-icons';
                    margin-right: 8px;
                    font-size: 0.8rem;
                    color: #2C74B3;
                }

                .footer-links a:hover {
                    color: white;
                    transform: translateX(5px);
                }

                .social-text {
                    color: rgba(255, 255, 255, 0.8);
                    margin-bottom: 1rem;
                }

                .social-links {
                    display: flex;
                    gap: 1rem;
                }

                .social-icon {
                    width: 40px;
                    height: 40px;
                    background: rgba(255, 255, 255, 0.1);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 8px;
                    color: white;
                    text-decoration: none;
                    transition: all 0.3s ease;
                }

                .social-icon:hover {
                    background: #2C74B3;
                    color: white;
                    transform: translateY(-3px);
                }

                .footer-bottom {
                    background: rgba(0, 0, 0, 0.2);
                    padding: 1.5rem 0;
                    margin-top: 3rem;
                }

                .copyright {
                    color: rgba(255, 255, 255, 0.8);
                    font-size: 0.9rem;
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

                @media (max-width: 768px) {
                    .footer-info, .footer-social {
                        text-align: center;
                    }

                    .footer-title::after {
                        left: 50%;
                        transform: translateX(-50%);
                    }

                    .social-links {
                        justify-content: center;
                    }

                    .footer-links {
                        text-align: center;
                    }
                }
            </style>
    <!-- Content Area -->
    <div id="content" style="margin-top: 50px;">
        <!-- Welcome Section -->
        <section id="home" class="landing-section text-center">
            <div class="content">
                <h1 class="section-title">Selamat Datang di Tracer Study</h1>
                @if($sekolah)
                    <h2>{{$sekolah->nama_sekolah}}</h2>
                @else

                <h2>Error</h2>
                @endif
                <p class="lead">Kami mengundang para alumni untuk berpartisipasi dalam penelusuran karir lulusan.</p>


                <a href="#kuesioner" class="btn btn-light btn-lg mt-4">Mulai Isi Kuesioner</a>
            </div>
        </section>

        <!-- About School Section -->
        <section id="about" class="landing-section text-center">
            @if($sekolah)
            <h2>{{$sekolah->nama_sekolah}}</h2>
           @else

             <h2>Tentang Sekolah Kami</h2>
          @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p>SMK Antartika 1 Sidoarjo adalah sekolah menengah kejuruan unggulan yang telah berdiri sejak tahun 1974. Dengan komitmen untuk menghasilkan lulusan berkualitas, kami terus mengembangkan program pendidikan yang relevan dengan kebutuhan industri.</p>
                </div>
            </div>
        </section>

        <!-- Questionnaire Section -->
        <section id="kuesioner" class="landing-section">
            <h2 class="text-center">Kuesioner Alumni</h2>
            <div class="text-center">
                @auth
                    @if(auth()->user()->alumni)
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="card questionnaire-card">
                                    <div class="card-body text-center">
                                        <div class="icon-wrapper mb-4">
                                            <i class="bi bi-briefcase-fill"></i>
                                        </div>
                                        <h5>Saya Sudah Bekerja</h5>
                                        <p class="text-muted">Isi kuesioner untuk alumni yang sudah bekerja</p>
                                        <a href="{{ route('tracer_kerja.create') }}" class="btn btn-primary">
                                            <i class="bi bi-pencil-square"></i> Isi Kuesioner
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card questionnaire-card">
                                    <div class="card-body text-center">
                                        <div class="icon-wrapper mb-4">
                                            <i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                        <h5>Saya Sedang Kuliah</h5>
                                        <p class="text-muted">Isi kuesioner untuk alumni yang melanjutkan kuliah</p>
                                        <a href="{{ route('tracer_kuliah.create') }}" class="btn btn-primary">
                                            <i class="bi bi-pencil-square"></i> Isi Kuesioner
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p>Anda harus mendaftar sebagai alumni terlebih dahulu sebelum mengisi kuesioner</p>
                            <a href="{{ route('alumni.register') }}" class="btn btn-primary">Daftar Sebagai Alumni</a>
                        </div>
                    @endif
                @else
                    <p>Silakan login terlebih dahulu untuk mengisi kuesioner</p>
                    <div>
                        <a href="{{ route('register') }}" class="btn btn-primary me-2">Daftar</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                    </div>
                @endauth
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimoni" class="landing-section text-center">
            <h2>Testimoni Alumni</h2>
            <div class="row testimonials-container justify-content-center">
                @forelse($recentTestimonis as $testimoni)
                    <div class="col-md-4">
                        <div class="card testimonial-card">
                            <div class="card-body">
                                <div class="testimonial-content text-center">
                                    <i class="bi bi-quote"></i>
                                    <p>{{ $testimoni->testimoni }}</p>
                                </div>
                                <div class="testimonial-author">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Profile">
                                    <div>
                                        <h5>{{ $testimoni->alumni->nama_depan }} {{ $testimoni->alumni->nama_belakang }}</h5>
                                        <p class="text-muted">{{ \Carbon\Carbon::parse($testimoni->tgl_testimoni)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Belum ada testimoni</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Footer Section -->
        <footer id="contact" class="footer-section">
            <div class="footer-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-4 footer-info">
                            <div class="footer-brand mb-4">
                                <h4>SMK Antartika 1 Sidoarjo</h4>
                            </div>
                            <div class="contact-details">
                                <p><i class="bi bi-geo-alt-fill"></i> Jl.Siwalan Panji, Buduran, Sidoarjo</p>
                                <p><i class="bi bi-telephone-fill"></i> (031) 8945444</p>
                                <p><i class="bi bi-envelope-fill"></i> SMKAntartika1sda@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4 class="footer-title">Quick Links</h4>
                            <ul class="footer-links">
                                <li><a href="#home">Beranda</a></li>
                                <li><a href="#about">Tentang Kami</a></li>
                                <li><a href="#kuesioner">Kuesioner</a></li>
                                <li><a href="#testimoni">Testimoni</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 footer-social">
                            <h4 class="footer-title">Ikuti Kami</h4>
                            <p class="social-text">Tetap terhubung dengan kami di media sosial</p>
                            <div class="social-links">
                                <a href="#" class="social-icon" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" class="social-icon" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" class="social-icon" title="Twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="#" class="social-icon" title="YouTube">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="copyright text-center">
                            <p>&copy; {{ date('Y') }} SMK Antartika 1 Sidoarjo. Created with 
                                <i class="bi bi-heart-fill text-danger"></i> by 
                                <span class="fw-bold">Nadiva Sulistyaningsih</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection