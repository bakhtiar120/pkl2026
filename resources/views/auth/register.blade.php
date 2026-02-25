<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>PKL Online Indonesia Power</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <!-- Favicons -->
      <link href="assets_ip2022/img/favicon.png" rel="icon">
      <!-- <link href="assets_ip2022/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
         rel="stylesheet">
      <link
         href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
         rel="stylesheet">
      <!-- Vendor CSS Files -->
      <link href="assets_ip2022/vendor/aos/aos.css" rel="stylesheet">
      <link href="assets_ip2022/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets_ip2022/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="assets_ip2022/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
      <link href="assets_ip2022/vendor/remixicon/remixicon.css" rel="stylesheet">
      <link href="assets_ip2022/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
      <!-- Template Main CSS File -->
      <link href="assets_ip2022/css/style.css" rel="stylesheet">
   </head>
   <body>
      <!-- ======= Header ======= -->
      @include('sweetalert::alert')
      <header id="header" class="header fixed-top header-scrolled">
         <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
            <img src="assets_ip2022/img/logo.png" alt="">
            </a>
            <nav id="navbar" class="navbar">
               <ul>
                  <li>
                     <a class="nav-link scrollto" href="/">Beranda</a>
                  </li>
                  <li>
                     <a class="nav-link scrollto" href="/#info-pkl-home">Info PKL</a>
                  </li>
                  <!-- <li>
                     <a class="nav-link scrollto" href="login">Masuk</a>
                  </li> -->
                  <li>
                     <a class="getstarted scrollto" href="login">Masuk</a>
                  </li>
               </ul>
               <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
         </div>
      </header>
      <!-- End Header -->
      <main id="main">
        <!-- ======= About Section ======= -->
        <!-- End Recent Blog Posts Section -->

        <!-- ======= Contact Section ======= -->
        <section id="register-akun" class="register-akun">

            <div class="p-5"></div>

            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                  
                  <div class="col-xl-3 col-lg-5 col-md-4" style="margin: 0px;padding: 0px;">
                    <div class="fotosamping" style="height: 100%;">
                      <img class="img-fluid" src="./assets_ip2022/img/foto_register.png" style="height: 100%;width: auto;object-fit: cover;object-position: right bottom;">
                    </div>
                  </div>
        
                  <div class="col-xl-3 col-lg-5 col-md-5 p-4" style="background-color: #ffffff;">
                    <form method="POST" autocomplete="off" action="{{ route('register') }}">
                    <div class="col-md-12 p-2">
                        <!-- <p class="h6" style="color: #757575;">Selamat datang di<br>PKL PT.Indonesia Power Kamojang POMU</p> -->
                        <p class="h4"><b>Daftarkan Akun Anda</b></p>
                        <p class="belum-punya" style="color: #757575;font-size: 14px !important;">Sudah Punya Akun?
                            <a href="login" class="belum-punya-biru" style="font-size: 14px !important;font-weight: 600;">Masuk</a></p>
                            @if ( Session::get('error'))
                            <div class="text-danger">
                                {{ Session::get('error') }}
                            </div> 
                            @endif
                            @if ( Session::get('success'))
                                        <div class="text-success">
                                            {{ Session::get('success') }}
                                        </div>
                            @endif
                            @if(!Session::get('error') && !Session::get('success'))
                                    <!-- <p>Daftarkan Akun Anda</p> -->
                            @endif
                            
                            @csrf
                    </div>
                     @if($errors->has('password'))
                          <div class="alert alert-danger p-0 mb-1 text-center" role="alert">
                              <span style="font-size:12px;">{{ $errors->first('password') }}</span>
                           </div>
                     @endif
                    <div class="row mb-2 p-2">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label id="label-form">Email</label>
                          <input type="email" class="form-control" name="email" placeholder="Masukkan Email Anda" required>
                          @if($errors->has('email'))
                          <div class="error">{{ $errors->first('email') }}</div>
                      @endif
                        </div>
                      </div>
                    </div>
                    <div class="row mb-2 p-2">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label id="label-form">Password</label>
                          <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password"  name="password" placeholder="Minimal 8 Karakter" required>
                            <div class="input-group-append">
                              <a href="" class="btn btn-light rounded-right" style="border-color: #ced4da;border-radius: 0px 4px 4px 0px;"><i class="bi bi-eye-slash"
                                  aria-hidden="true"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4 p-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="label-form">Konfirmasi Password</label>
                                <div class="input-group" id="show_hide_konfirmasi_password">
                                    <input class="form-control" type="password" placeholder="Masukkan Password Konfirmasi" name="password_confirmation" required>
                                    <div class="input-group-append">
                                        <a href="" class="btn btn-light rounded-right" style="border-color: #ced4da;border-radius: 0px 4px 4px 0px;"><i
                                                class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0 p-2">
                      <div class="col-md-12 text-center">
                        <button class="btn btn-indonesia-power" type="submit">Daftar</button>
                      </div>
                    </div>
                  </form>
                    <!-- FORM END -->
                  </div>
                </div>
              </div>

              <div class="p-4"></div>
        

        </section><!-- End register-akun Section -->

    </main><!-- End #main -->
      <!-- End #main -->
      <!-- ======= Footer ======= -->
      <footer id="footer" class="footer">
         <div class="footer-top">
            <div class="container">
               <div class="row gy-4">
                  <div class="col-lg-5 col-md-12 footer-info">
                     <a href="/">
                     <img src="assets_ip2022/img/logo_footer.png" alt="" width="260px" height="100px">
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
      </footer>
      <!-- End Footer -->
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
         class="bi bi-arrow-up-short"></i></a>
      <!-- Vendor JS Files -->
      <script src="assets_ip2022/vendor/purecounter/purecounter.js"></script>
      <script src="assets_ip2022/vendor/aos/aos.js"></script>
      <script src="assets_ip2022/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets_ip2022/vendor/glightbox/js/glightbox.min.js"></script>
      <script src="assets_ip2022/vendor/isotope-layout/isotope.pkgd.min.js"></script>
      <script src="assets_ip2022/vendor/swiper/swiper-bundle.min.js"></script>
      <!-- <script src="assets_ip2022/vendor/php-email-form/validate.js"></script> -->
      <script src="assets_ip2022/js/jquery.js"></script>
      <!-- Template Main JS File -->
      <script src="assets_ip2022/js/main.js"></script>
      <script src="assets_ip2022/js/sendiri.js"></script>
      <script src="assets_ip2022/js/show_hide.js"></script>
   </body>
</html>