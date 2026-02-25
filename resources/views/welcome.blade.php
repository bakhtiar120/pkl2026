<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PKL Online PT PLN Indonesia Power Kamojang POMU</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets_ip2022/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>

  <!-- Vendor CSS Files -->
  <link href="/assets_ip2022/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets_ip2022/css/style.css" rel="stylesheet">
  <link href="/assets_ip2022/css/styleslider.css" rel="stylesheet">



</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top header-scrolled">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="/assets_ip2022/img/logo.png" alt="">

      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li>
            <a class="nav-link scrollto" href="#">Beranda</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="#info-pkl-home">Info PKL</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="#profil-perusahaan">Profil Perusahaan</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="#pkl">Bidang PKL</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="#syarat">Syarat PKL</a>
          </li>
          @if(Auth::guest())
              <li>
                <a class="nav-link scrollto" href="login">Masuk</a>
              </li> 
              <li>
                <a class="getstarted scrollto" href="register">Daftar</a>
              </li> 
          @else
            @switch(Auth::user()->role)
                @case(1)
                <li>
                  <a class="getstarted scrollto" href="admin/dashboard">Masuk</a>
                </li>
                    @break 
                @case(2)
                <li>
                  <a class="getstarted scrollto" href="user/dashboard">Masuk</a>
                </li>
                    @break
                @case(3)
                <li>
                  <a class="getstarted scrollto" href="mentor/dashboard">Masuk</a>
                </li>
                    @break 
                @default
              
            @endswitch
          @endif 
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header --> 
 

  <main id="main">
    <div class="atas">
    </div>


    <section id="pkl-top" class="content-section-wrapper pkl-top d-flex align-items-center">

      <div class="container">
        <div class="row">
          <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1">
            <h1 data-aos="fade-up">Praktek Kerja Lapangan<br>PT PLN Indonesia Power<br>Kamojang POMU</h1>
            <h5 data-aos="fade-up" data-aos-delay="400">Aplikasi pendaftaran Praktek Kerja Lapangan (PKL)<br>untuk Pelajar dan Mahasiswa</h5>
            <div data-aos="fade-up" data-aos-delay="600">
              <div class="top-profile">
                <a href="/register"
                  class="button_top scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Daftar Sekarang</span>

                </a>
                <a href="/login"
                  class="button_top_white scrollto d-inline-flex align-items-center justify-content-center align-self-center ">
                  <span>Masuk</span>

                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 pkl-top-img order-1 order-lg-2" data-aos="zoom-out" data-aos-delay="100">
            <img src="/assets_ip2022/img/Frame 34.png" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </section> 

    <section id="info-pkl-home" class="info-pkl-home" >
      <div class="container">
        <div class="info-box p-4 row">
          <div class="col-md-2">
            <p id="title-info-pkl-home" class="h2">Info<br>PKL</p>
            <div style="margin-top: 40px;margin-bottom: 12px;">
              <a href="#" class="link-lainya">
                <span id="title-info-pkl-home">Info Lainnya</span>
                <i id="icon-info-lainnya" class="bi bi-arrow-right" style="margin-left: 5px;"></i>
              </a>
            </div>
          </div>
          <div class="col-md-10">
            <div class="row">
              <div
                class="col-md-1 order-2 order-lg-1 d-inline-flex align-items-center justify-content-center align-self-center">
                <button type="button" class="btn btn-light" data-bs-target="#carouselExampleControls"
                  data-bs-slide="prev" style="align-items: center;"><i class="bi bi-arrow-left"></i></button>
              </div>
              <div class="col-md-10 order-1 order-lg-2">
                <div id="carouselExampleControls" class="carousel slide carousel-multi-item" data-bs-interval="false">
                  <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">

                      <div class="col-md-6 col-sm-12 p-2 pengumuman-0" style="float:left; display: none;">
                        <div class="bd-callout bd-callout-warning">
                          <div class="row">
                            <div class="col-md-1">
                              <p id="format-tanggal-box" class="tgl-0">10</p>
                              <p id="format-bulan-box" class="bln-0">Des</p>
                            </div>
                            <div class="col-md-11">
                              <p id="title-info-pkl-box" class="judul-0">Pengumuman</p>
                              <p id="content-info-pkl-box" class="isi-0">Pengumuman lulus administrasi dapat dilihat pada tanggal 25
                                Januari 2022 dengan cara login menggunakan akun pendaftaran pada website PKL Online PT PLN Indonesia Power Kamojang POMU</p>
                              <div class="text-end" style="margin-right:24px; padding-bottom: 12px;">
                                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center link-0">
                                  <span>Selengkapnya</span>
                                  <i class="bi bi-arrow-right" style="margin-left: 5px;"></i>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>


                      <div class="col-md-6 p-2 pengumuman-1" style="float:left; display: none;">
                        <div class="bd-callout bd-callout-warning">
                          <div class="row">
                            <div class="col-md-1">
                              <p id="format-tanggal-box" class="tgl-1">10</p>
                              <p id="format-bulan-box" class="bln-1">Des</p>
                            </div>
                            <div class="col-md-11">
                              <p id="title-info-pkl-box" class="judul-1">Pengumuman</p>
                              <p id="content-info-pkl-box" class="isi-1">Pengumuman lulus administrasi dapat dilihat pada tanggal 25
                                Januari 2022 dengan cara login menggunakan akun pendaftaran pada website PKL Online PT PLN Indonesia Power Kamojang POMU</p>
                              <div class="text-end" style="margin-right:24px; padding-bottom: 12px;">
                                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center link-1">
                                  <span>Selengkapnya</span>
                                  <i class="bi bi-arrow-right" style="margin-left: 5px;"></i>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="carousel-item">
                      
                      <div class="col-md-6 p-2 pengumuman-2" style="float:left; display: none;">
                        <div class="bd-callout bd-callout-warning">
                          <div class="row">
                            <div class="col-md-1">
                              <p id="format-tanggal-box" class="tgl-2">10</p>
                              <p id="format-bulan-box" class="bln-2">Des</p>
                            </div>
                            <div class="col-md-11">
                              <p id="title-info-pkl-box" class="judul-2">Pengumuman</p>
                              <p id="content-info-pkl-box" class="isi-2">Pengumuman lulus administrasi dapat dilihat pada tanggal 25
                                Januari 2022 dengan cara login menggunakan akun pendaftaran pada website PKL Online PT PLN Indonesia Power Kamojang POMU</p>
                              <div class="text-end" style="margin-right:24px; padding-bottom: 12px;">
                                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center link-2">
                                  <span>Selengkapnya</span>
                                  <i class="bi bi-arrow-right" style="margin-left: 5px;"></i>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6 p-2 pengumuman-3" style="float:left; display: none;">
                        <div class="bd-callout bd-callout-warning">
                          <div class="row">
                            <div class="col-md-1">
                              <p id="format-tanggal-box" class="tgl-3"> 03</p>
                              <p id="format-bulan-box" class="bln-3"> Mar</p>
                            </div>
                            <div class="col-md-11">
                              <p id="title-info-pkl-box" class="judul-3">Pengumuman  </p>
                              <p id="content-info-pkl-box" class="isi-3">
                              
                                Pengumuman lulus administrasi dapat dilihat pada tanggal 25
                                Januari 2022 dengan cara login menggunakan akun pendaftaran pada website PKL Online PT PLN Indonesia Power Kamojang POMU
                                  
                              </p>
                              <div class="text-end" style="margin-right:24px; padding-bottom: 12px;">
                                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center link-3">
                                  <span>Selengkapnya</span>
                                  <i class="bi bi-arrow-right" style="margin-left: 5px;"></i>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div
                class="col-md-1 order-3 order-lg-3 d-inline-flex align-items-center justify-content-center align-self-center">
                <button type="button" class="btn btn-light" data-bs-target="#carouselExampleControls"
                  data-bs-slide="next"><i class="bi bi-arrow-right"></i></button>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </section>


    <section id="profil-perusahaan" class="profil-perusahaan">

      <div class="container" data-aos="fade-up">


        <div class="row">

          <div class="col-lg-6">
            <div id="carouselProfilExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselProfilExampleIndicators" data-bs-slide-to="0"
                  class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselProfilExampleIndicators" data-bs-slide-to="1"
                  aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselProfilExampleIndicators" data-bs-slide-to="2"
                  aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselProfilExampleIndicators" data-bs-slide-to="3"
                  aria-label="Slide 4"></button>
              </div>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active" data-bs-interval="3000">
                  <img class="d-block w-100" style="float:left" src="./assets_ip2022/img/slide1.png" alt="First slide">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                  <img class="d-block w-100" style="float:left" src="./assets_ip2022/img/slide2.png" alt="Second slide">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                  <img class="d-block w-100" style="float:left" src="./assets_ip2022/img/slide3.png" alt="Third slide">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                  <img class="d-block w-100" style="float:left" src="./assets_ip2022/img/slide4.png" alt="Third slide">
                </div>
              </div>
            </div> 
          </div>
          <div class="col-lg-6">
            <div class="col-lg-12">
              <p class="h2" style="font-weight: bold;">Profil<br>PT PLN Indonesia Power<br>Kamojang POMU</p>
            </div>
            <div class="col-lg-12">
              <br>
              <p id="content-profile-perusahaan">
              PT PLN Indonesia Power Kamojang Power Generation and O&M Services Unit (POMU) mengelola Pembangkit Listrik Tenaga Panas Bumi (PLTP) yang terdiri dari 17 unit berkapasitas sebesar 575MW diantaranya :
              </p>
              <ol>
                <li>Unit PLTP Kamojang (3 Unit sebesar 140 MW) yang terletak di Desa Laksana, Kec. Ibun, Kab. Bandung - Jawa Barat;</li>
                <li>Unit PLTP Darajat (1 Unit sebesar 55 MW) yang terletak di Desa Padaawas, Kec. Pasirwangi, Kab. Garut - Jawa Barat;</li>
                <li>Unit PLTP Gunung Salak (3 Unit Sebesar 180 MW) yang terletak di Desa Purwabakti, Kec. Pamijahan, Kab. Sukabumi - Jawa Barat;</li>
                <li>Unit PLTP Lahendong (4 Unit Sebesar 80 MW) yang terletak di Leilem Dua, Sonder, Kota Tomohon - Sulawesi Utara;</li>
                <li>Unit PLTP Ulubelu (2 Unit Sebesar 110 MW) yang terletak di Desa Pagaralam, Kec. Ulubelu, Kab. Tanggamus - Lampung;</li>
              </ol>
              <p>Selain mengelola pembangkit yang dimiliki PT PLN Indonesia Power, Kamojang POMU juga mengelola jasa O&M PLTP milik PT PLN (persero) yaitu Unit PLTP Ulumbu (4 Unit Sebesar 10 MW) yang terletak di Desa Wewo, Kec. Satarmese, Kab. Manggarai - Nusa Tenggara Timur.</p>
              <p>Kamojang POMU juga merupakan pionerr pengelolaan PLTP di Indonesia yang mana unit PLTP Kamojang merupakan PLTP Pertama di Indonesia dan sudah banyak meraih penghargaan salah satunya PROPER Emas dari Kementerian Lingkungan Hidup dan Kehutanan Republik Indonesia. Energi panas bumi merupakan salah satu sumber energi yang dapat diperbaharui (renewable) dan tentunya ramah lingkungan.</p>
            </div>
          </div>
        </div>



      </div>
      <!-- / row -->


      </div>

    </section>


    <!-- jenis pkl -->
    <section id="pkl" class="pkl"> 
      <div class="container" data-aos="fade-up"> 
        <header class="section-header"> 
          <p class="h2" style="font-weight: bold;">Deskripsi Bidang PKL</p>
        </header> 
        <div class="row gy-4"> 
        
        @foreach ($bidangs as $bidang)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="pkl-box white">
              <img src="/upload/{{ $bidang->icon }}" height="69px" width="69px">
              <h5>{{$bidang->nama_bidang}}</h5>
              <p>{{$bidang->deskripsi}}</p>
              <br />
              <p class="pkl-bold">Jurusan : {{$bidang->jurusan}}</p> 
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <section id="syarat" class="syaratpkl">
      <div class="container">
        <div class="row">
          <div class="col-md-5" style="text-align: left;">

            <div class="col-md-12">
              <p class="h4 p-2" style="font-weight: bold;">Syarat Pendaftaran<br>PKL Online</p>
            </div>
            <div class="col-md-12 syaratpkl-box p-2">
              <span style="float: left;"><i class="bi bi-exclamation-circle-fill p-2"></i></span>
              <div style="display: flex;">
                <p>Catatan Point 1 sampai dengan 6 dijadikan dalam satu file dan tidak
                  lebih besar dari 2 MB</p>
              </div>
            </div>
            <div class="col-md-12">
              <p class="p-4">
                <span style="float: left;">1.&nbsp;</span><span style="display: flex;">Surat Pengajuan Praktek Kerja Lapangan (PKL) dari Instansi Pendidikan terkait<br></span>
                <span style="float: left;">2.&nbsp;</span><span style="display: flex;">Proposal Praktek Kerja Lapangan (PKL)<br></span>
                <span style="float: left;">3.&nbsp;</span><span style="display: flex;">Transkrip Nilai sampai dengan semester terakhir<br></span>
                <span style="float: left;">4.&nbsp;</span><span style="display: flex;">Curriculum Vitae<br></span>
                <span style="float: left;">5.&nbsp;</span><span style="display: flex;">Kartu Pelajar / Mahasiswa<br></span>
                <span style="float: left;">6.&nbsp;</span><span style="display: flex;">Pas Foto 3x4 menggunakan background merah<br></span>
                {{-- <span style="float: left;">7.&nbsp;</span><span style="display: flex;">Surat Kesediaan<br></span> --}}
              </p>
            </div>
          </div>
          <div class="col-md-2">
          </div>
          <div class="col-md-5">
            <div class="col-md-12">
              <p class="h4 p-2" style="font-weight: bold;">Surat Edaran General Manager<br>PT PLN Indonesia Power Kamojang POMU</p>
            </div>
            <div class="col-md-12">
              <a href={{url('download-se')}}>
              <button type="button" class="btn btn-block btn-indonesia-power">
                <i class="bi bi-file-earmark-text" style="color: #ffffff;"></i>&nbsp;{{$fileupload}}</button>
              </a>
            </div> 
          </div>
        </div>
      </div> 
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html">
              <img src="/assets_ip2022/img/logo_footer.png" alt="" width="260px" height="100px">
            </a>
          </div>
          <div class="col-lg-3 col-6 footer-links">
            <h4>Kontak Kami</h4>
            <ul>
              <li><i class="bi bi-geo-alt"></i> <a href="#">Desa Laksana,Ibun, Kabupaten Bandung, Jawa Barat</a></li>
              <li><i class="bi bi-telephone"></i> <a href="#">(022) 7814478, (0262) 229150</a></li>
              <li><i class="bi bi-envelope"></i> <a href="#">humas.kmj@indonesiapower.co.id</a></li>
            </ul>
          </div>
          <div class="col-lg-1 col-6 footer-links">
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-md-start">
            <h4>Sosial Media</h4>
            <a href="https://www.youtube.com/channel/UCPulnU-un0DplD1yco24MLQ"><img src="./assets_ip2022/img/youtube_logo.png" width="32px" height="auto" style="margin-right: 10px;"></a>
            <a href="https://www.instagram.com/plnindonesiapower.kmj/"><img src="./assets_ip2022/img/instagram.png"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="container footer-bottom clearfix">
      <div class="float-start">
        <h5>Copyright © 2021 PT PLN Indonesia Power Kamojang POMU. All rights reserved.Version 1.0.0</h5>
      </div>
      <div class="float-end">
        <h5>Version 1.0.0</h5>
      </div>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="/assets_ip2022/vendor/purecounter/purecounter.js"></script>
  <script src="/assets_ip2022/vendor/aos/aos.js"></script>
  <script src="/assets_ip2022/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets_ip2022/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets_ip2022/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets_ip2022/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/assets_ip2022/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="/assets_ip2022/js/main.js"></script>
  <script src="/assets_ip2022/js/slider.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script>
     $.get(`/api/get-pengumuman-4`).done(function( data ) { 
         if (data.data[0].length !=0) {
             $( ".pengumuman-0" ).show();          
             $('.link-lainya').attr('href',`/post/${data.data[0].id}`);
             $('.isi-0').html(data.data[0].isi.replace(/<[^>]+>/g, '').substring(0, 162)+' ...');
             $('.judul-0').html(data.data[0].judul);
             $('.link-0').attr('href',`/post/${data.data[0].id}`);
             $('.tgl-0').html(moment(data.data[0].created_at).locale('id').format('DD'));
             $('.bln-0').html(moment(data.data[0].created_at).locale('id').format('MMM'));             
         }
         if (data.data[1].length !=0) {
             $( ".pengumuman-1" ).show();
             $('.isi-1').html(data.data[1].isi.replace(/<[^>]+>/g, '').substring(1, 162)+' ...');
             $('.judul-1').html(data.data[1].judul);
             $('.link-1').attr('href',`/post/${data.data[1].id}`);
             $('.tgl-1').html(moment(data.data[1].created_at).locale('id').format('DD'));
             $('.bln-1').html(moment(data.data[1].created_at).locale('id').format('MMM'));             
         }
         if (data.data[2].length !=0) {
             $( ".pengumuman-2" ).show();
             $('.isi-2').html(data.data[2].isi.replace(/<[^>]+>/g, '').substring(2, 162)+' ...');
             $('.judul-2').html(data.data[2].judul);
             $('.link-2').attr('href',`/post/${data.data[2].id}`);
             $('.tgl-2').html(moment(data.data[2].created_at).locale('id').format('DD'));
             $('.bln-2').html(moment(data.data[2].created_at).locale('id').format('MMM'));             
         }
         if (data.data[3].length !=0) {
             $( ".pengumuman-3" ).show();
             $('.isi-3').html(data.data[3].isi.replace(/<[^>]+>/g, '').substring(3, 163)+' ...');
             $('.judul-3').html(data.data[3].judul);
             $('.link-3').attr('href',`/post/${data.data[3].id}`);
             $('.tgl-3').html(moment(data.data[3].created_at).locale('id').format('DD'));
             $('.bln-3').html(moment(data.data[3].created_at).locale('id').format('MMM'));             
         }
        });
  </script>
</body>
</html>
