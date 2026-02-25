<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PKL PT PLN Indonesia Power UBP Kamojang</title>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('resendBtn');
        const text = document.getElementById('cooldownText');

        if (!btn) return;

        let cooldown = parseInt(btn.dataset.cooldown || 0);

        if (cooldown > 0) {
            let interval = setInterval(function() {
                cooldown--;

                if (cooldown <= 0) {
                    clearInterval(interval);
                    btn.disabled = false;
                    text.innerText = '';
                } else {
                    text.innerText = `(${cooldown} s)`;
                }
            }, 1000);
        }
    });
</script>


<body>
    <!-- ======= Header ======= -->
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
                        <a class="getstarted scrollto" href="register">Daftar</a>
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
        <section id="login-akun" class="login-akun">

            <div class="p-5"></div>

            <div class="container-fluid">
                <div class="row d-flex justify-content-center">

                    <div class="col-xl-3 col-lg-5 col-md-4" style="margin: 0px;padding: 0px;">
                        <div class="fotosamping" style="height: 100%;">
                            <img class="img-fluid" src="./assets_ip2022/img/potosampul25x.jpg"
                                style="height: 100%;width: auto;object-fit: cover;object-position: right bottom;">
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-5 col-md-5 p-4" style="background-color: #ffffff;">
                        @php
                            $isBlocked = $otpData && $otpData->blocked_until && now()->lt($otpData->blocked_until);
                        @endphp

                        {{-- JUDUL --}}
                        <div class="col-md-12 p-2">
                            <p class="h4"><b>Verify OTP</b></p>
                            <p class="belum-punya" style="color: #757575;font-size: 14px !important;">
                                Masukan 6 kode OTP yang telah dikirim ke email <b>email@tester.com</b>
                            </p>
                        </div>

                        {{-- TEMP BLOCK ALERT --}}
                        @if ($isBlocked)
                            <div class="alert alert-danger text-center">
                                Your account is temporarily blocked until
                                {{ $otpData->blocked_until->format('H:i:s') }}.
                            </div>
                        @endif

                        {{-- ERROR OTP --}}
                        @error('otp')
                            <div class="alert alert-danger p-0 mb-1 text-center" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror

                        {{-- SUCCESS --}}
                        @if (Session::get('success'))
                            <div class="alert alert-success p-0 mb-1 text-center" role="alert">
                                <span style="font-size:12px;">{{ Session::get('success') }}</span>
                            </div>
                        @endif

                        {{-- ========== FORM VERIFY OTP ========== --}}
                        <form method="POST" action="{{ route('otp.verify') }}">
                            @csrf

                            <div class="row mb-2 p-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label id="label-form">Kode OTP</label>
                                        <input type="text" class="form-control" name="otp" maxlength="6"
                                            required autofocus {{ $isBlocked ? 'disabled' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0 p-2">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-indonesia-power" type="submit"
                                        {{ $isBlocked ? 'disabled' : '' }}>
                                        Verify
                                    </button>
                                </div>
                            </div>
                        </form>

                        {{-- ========== FORM RESEND OTP ========== --}}
                        <div class="row mb-0 p-2">
                            <div class="col-md-12 text-center">

                                <form method="POST" action="{{ route('otp.resend') }}">
                                    @csrf

                                    <button type="submit" id="resendBtn" class="btn btn-secondary"
                                        data-cooldown="{{ $cooldown }}"
                                        {{ $isBlocked || $cooldown > 0 ? 'disabled' : '' }}>
                                        Resend OTP
                                        <span id="cooldownText">
                                            {{ $cooldown > 0 ? "($cooldown s)" : '' }}
                                        </span>
                                    </button>
                                </form>

                            </div>
                        </div>

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
                            <img src="assets_ip2022/img/logo_footer.png" alt="" width="260px"
                                height="100px">
                        </a>
                    </div>
                    <div class="col-lg-5 col-md-12 footer-links">
                        <h4>Kontak Kami</h4>
                        <ul>
                            <li><i class="bi bi-geo-alt"></i> <a href="#">Unit PLTP Kamojang – Jl. Raya
                                    Kamojang, Desa Laksana,<br>Kec. Ibun, Kab. Bandung – Jawa Barat 40384</a></li>
                            <li><i class="bi bi-telephone"></i> <a href="#">(022) 7814478, (0262) 229150</a>
                            </li>
                            <li><i class="bi bi-envelope"></i> <a href="#">humas.kmj@plnindonesiapower.co.id</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-12 footer-contact text-md-start">
                        <h4>Sosial Media</h4>
                        <a href="https://www.youtube.com/channel/UCPulnU-un0DplD1yco24MLQ"><img
                                src="./assets_ip2022/img/youtube_logo.png" width="32px" height="auto"
                                style="margin-right: 10px;"></a>
                        <a href="https://www.instagram.com/plnip.ubpkamojang/"><img
                                src="./assets_ip2022/img/instagram.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container footer-bottom clearfix">
            <div class="float-start">
                <h5>Copyright © 2025 PT PLN Indonesia Power UBP Kamojang. All rights reserved.Version 5.0.0</h5>
            </div>
            <div class="float-end">
                <h5>Version 5.0.0</h5>
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
    {{-- <script src="js/my-login.js"></script> --}}

    <script src="assets_ip2022/js/jquery.js"></script>
    <!-- Template Main JS File -->
    <script src="assets_ip2022/js/main.js"></script>
    {{-- <script src="assets_ip2022/js/sendiri.js"></script> --}}
    <script src="assets_ip2022/js/show_hide.js"></script>
</body>

</html>
