<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SIDORA | KABUPATEN BANDUNG</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('front/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('front/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('front/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('front/assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex justify-content-between align-items-center">

            <div id="logo">
                <a href="index.html"><img src="assets/img/logo.png" alt=""></a>
                <!-- Uncomment below if you prefer to use a text logo -->
                <!--<h1><a href="index.html">Regna</a></h1>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Branda</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="#services">Event</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Data Alat Olahraga</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Musernbang</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1>SIDORA KABUPATEN BANDUNG</h1>
            <h2>Sistem Informasi Data Sarana & Prasarana Keolahragaan Kabupaten Bandung</h2>
            <a href="#about" class="btn-get-started">Cari </a>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Facts Section ======= -->
        <section id="facts">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">Potensi Keolahragaan</h3>
                    <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                </div>
                <div class="row counters">

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{$kecamatan}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Kecamatan</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{$desaKelurahan}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Desa / kelurahan</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{$sarana}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Sarana</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{$potensiAtlet}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Prestasi Atlet</p>
                    </div>

                </div>

                <form class="row d-flex justify-content-center" action="{{route('detail')}}" method="get">
                    <div class="col-md-4 text-center">
                        <select type="text" class="form-control" name="kecamatan_id">
                            <option value="">Pilih Kecamatan</option>
                            @foreach($dataKecamatan as $dk)
                            <option value="{{$dk->id}}">{{$dk->kecamatan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 text-center">
                        <select type="text" class="form-control" name="desa_kelurahan_id">
                            <option value="">Pilih Desa / Kelurahan</option>
                            @foreach($dataDesaKelurahan as $d)
                            <option value="{{$d->id}}">{{$d->desa_kelurahan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-md btn-success btn-block">Cari</button>
                    </div>
                </form>

            </div>
        </section>
        <!-- End Facts Section -->

        <!-- ======= About Section ======= -->
        <section id="about">
            <div class="container" data-aos="fade-up">
                <div class="row about-container">

                    <div class="col-lg-6 content order-lg-1 order-2">
                        <h2 class="title">Few Words About Us</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bi bi-briefcase"></i></div>
                            <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
                        </div>

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="bi bi-card-checklist"></i></div>
                            <h4 class="title"><a href="">Magni Dolores</a></h4>
                            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                        </div>

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="bi bi-binoculars"></i></div>
                            <h4 class="title"><a href="">Dolor Sitema</a></h4>
                            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
                        </div>

                    </div>

                    <div class="col-lg-6 background order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100"></div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="services">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">Services</h3>
                    <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <div class="box">
                            <div class="icon"><a href=""><i class="bi bi-briefcase"></i></a></div>
                            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <div class="box">
                            <div class="icon"><a href=""><i class="bi bi-card-checklist"></i></a></div>
                            <h4 class="title"><a href="">Dolor Sitema</a></h4>
                            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <div class="box">
                            <div class="icon"><a href=""><i class="bi bi-bar-chart"></i></a></div>
                            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <div class="box">
                            <div class="icon"><a href=""><i class="bi bi-binoculars"></i></a></div>
                            <h4 class="title"><a href="">Magni Dolores</a></h4>
                            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <div class="box">
                            <div class="icon"><a href=""><i class="bi bi-brightness-high"></i></a></div>
                            <h4 class="title"><a href="">Nemo Enim</a></h4>
                            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <div class="box">
                            <div class="icon"><a href=""><i class="bi bi-calendar4-week"></i></a></div>
                            <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="call-to-action">
            <div class="container">
                <div class="row" data-aos="zoom-in">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3 class="cta-title">Call To Action</h3>
                        <p class="cta-text"> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle" href="#">Login</a>
                    </div>
                </div>

            </div>
        </section><!-- End Call To Action Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Dispora Kabupaten bandung</strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
      -->
                Support by <a href="https://bootstrapmade.com/">Aranka Tech Solution</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('front/assets/vendor/purecounter/purecounter.js')}}"></script>
    <script src="{{asset('front/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('front/assets/js/main.js')}}"></script>

</body>

</html>
