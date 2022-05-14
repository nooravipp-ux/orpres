<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inner Page - Regna Bootstrap Template</title>
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

    <style>
        table th,
        td {
            font-size: 12px;
        }
    </style>

    <!-- =======================================================
  * Template Name: Regna - v4.7.0
  * Template URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center ">
        <div class="container d-flex justify-content-between align-items-center">

            <div id="logo">
                <a href="index.html"><img src="assets/img/logo.png" alt=""></a>
                <!-- Uncomment below if you prefer to use a text logo -->
                <!--<h1><a href="index.html">Regna</a></h1>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">BRANDA</a></li>
                    <li><a class="nav-link scrollto" href="#about">DATA ALAT OLAHRAGA</a></li>
                    <li><a class="nav-link scrollto" href="#services">DATA POTENSI ATLET</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Data Keolahragaan</h2>
                    <ol>
                        <li><a href="/">Branda</a></li>
                        <li>Data Keolahragaan</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs Section -->

        <section class="inner-page pt-4">
            <div class="container">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Deskripsi Wilayah</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{route('sarana.storeP1P2')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="recipient-name" class="col-form-label col-md-2">Kecamatan</label>
                                <input type="text" class="form-control col-md-10" value="{{$data->kecamatan}}" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="recipient-name" class="col-form-label col-md-2">Desa / Kelurahan</label>
                                <input type="text" class="form-control col-md-10" value="{{$data->desa_kelurahan}}" readonly>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Fasilitas Sarana Olahraga</h6>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tbl-sarana">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis Sarana</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Kepemilikan</th>
                                    <th scope="col">Nama Pemilik</th>
                                    <th scope="col">Luas</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col" class="text-center">Foto Sarana</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($t_sarana as $sarana)
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td>{{$sarana->nama_sarana}}</td>
                                    <td>{{$sarana->tipe_sarana}}</td>
                                    <td>{{$sarana->status_kepemilikan}}</td>
                                    <td>{{$sarana->nama_pemilik}}</td>
                                    <td>{{$sarana->luas_lapang}}</td>
                                    <td>{{$sarana->alamat_lokasi}}</td>
                                    <td class="text-center">{{$sarana->kondisi_lapang}}</td>
                                    <td class="text-center">
                                        @if($sarana->foto_lokasi == "-")
                                        <span>-</span>
                                        @else
                                        <img src="{{asset('images/pendukung/'. $sarana->foto_lokasi)}}" width="300" height="200" alt="">
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Prasarana Olahraga Yang Diberikan Oleh Pemerintah</h6>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tbl-prasarana">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode Tahun</th>
                                    <th scope="col">Jenis Penerima</th>
                                    <th scope="col">Alamat Penerima</th>
                                    <th scope="col">Jenis Peralatan</th>
                                    <th class="text-center">Jumlah Peralatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $j = 1; ?>
                                @foreach($t_prasarana as $prasarana)
                                <tr>
                                    <td><?php echo $j++; ?></td>
                                    <td></td>
                                    <td>{{$prasarana->jenis_penerima}}</td>
                                    <td></td>
                                    <td>{{$prasarana->nama_prasarana}}</td>
                                    <td class="text-center">{{$prasarana->jumlah}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kegiatan Olahraga Yang Berkembang Di Masyarakat</h6>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tbl-kegiatan-olahraga">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis Olahraga</th>
                                    <th scope="col">Nama Club</th>
                                    <th scope="col">Ketua Club</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th class="text-center">Dibina Desa ?</th>
                                    <th class="text-center">Diunggulkan Desa ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $k = 1; ?>
                                @foreach($t_kel_olahraga as $ko)
                                <tr>
                                    <td><?php echo $k++; ?></td>
                                    <td>{{$ko->nama_cabang_olahraga }}</td>
                                    <td>{{$ko->nama_club}}</td>
                                    <td>{{$ko->ketua_club}}</td>
                                    <td>{{$ko->alamat}}</td>
                                    <td>
                                        @if($ko->status_club == 0)
                                        <span>Tidak Terdaftar</span>
                                        @else
                                        <span>Terdaftar</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$ko->dibina_desa}}</td>
                                    <td class="text-center">{{$ko->diunggulkan_desa}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Potensi Olahraga Prestasi Yang Ada Di Wilayah</h6>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tbl-potensi-olahraga">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Atlet</th>
                                    <th scope="col">Jenis Olahraga</th>
                                    <th scope="col">Jenis Potensi</th>
                                    <th scope="col">Tingkat Prestasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $l = 1; ?>
                                @foreach($t_prestasi_olahraga as $po)
                                <tr>
                                    <td><?php echo $l++; ?></td>
                                    <td>{{$po->nama}}</td>
                                    <td>{{$po->nama_cabang_olahraga}}</td>
                                    <td>{{$po->jenis_potensi}}</td>
                                    <td>{{$po->tingkat_prestasi}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

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
